var Q = require('q'),
    fs = require('fs'),
    http = require('http'),
    faye = require('faye'),
    yaml = require('js-yaml'),
    mysql = require('mysql');

var serverFayeBrowser = http.createServer(),
    bayeux = new faye.NodeAdapter({mount: '/faye', timeout: 5});

var PORT_CLIENT = 8000;
var PORT_SYMFONY = 8001;

var db = new function()  {

    var sf_config = yaml.safeLoad(fs.readFileSync('../app/config/parameters.yml', 'utf8'));
    var db_config = {
        host:     sf_config.parameters.database_host,
        user:     sf_config.parameters.database_user,
        password: sf_config.parameters.database_password,
        database: sf_config.parameters.database_name
    };

    var connection;

    function connect()
    {
        connection = mysql.createConnection(db_config);

        connection.connect(function(err){
            if (err)
                setTimeout(connect, 2000);
        });

        connection.on('error', function(err) {
            if (err.code === 'PROTOCOL_CONNECTION_LOST')
                connect();
            else
                throw err;
        });
    }

    connect();

    return connection;
};

var serverAuth = {
    incoming: function(message, callback) {
        if (message.channel !== '/meta/subscribe')
            return callback(message);

        var subscription = message.subscription.substring(1),
            msgToken     = message.ext && message.ext.authToken;

        callbackIfUserExists(subscription, msgToken, function(){
            callback(message);
        });
    }
};

function callbackIfUserExists(id, token, callback)
{
    db.query(
        'SELECT COUNT(*) AS count FROM User WHERE id = ? AND fayeToken = ?',
        [id, token],
        function(err, rows, fields)
    {
        if (err)
            throw err;

        if (rows[0].count)
            callback();
    });
};

bayeux.addExtension(serverAuth);

bayeux.attach(serverFayeBrowser);
serverFayeBrowser.listen(PORT_CLIENT);

//

serverFayeSymfony = http.createServer(function(req, res){

    if (req.headers.host != 'localhost:'+PORT_SYMFONY) {
        res.end();
        return;
    }

    var body = '';
    req.on('data', function (data) {
        body += data;
    });
    req.on('end', function () {

        var data = JSON.parse(body);

        bayeux.getClient().publish('/'+data.id, data.data);

        res.end();
    });

});
serverFayeSymfony.listen(PORT_SYMFONY);

//

function print_r(o) {
    function f(o, p, s) {
        for (var x in o) {
            if ('object' == typeof o[x]) {
                s += p + x + ' obiekt: \n';
                pre = p + '\t';
                s = f(o[x], pre, s);
            } else {
                s += p + x + ' : ' + o[x] + '\n';
            }
        }
        return s;
    }
    return f(o, '', '');
}
