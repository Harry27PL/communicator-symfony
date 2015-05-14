'use strict';

define(['Chat/Chat'],
function (Chat) {

    History.Adapter.bind(window, 'statechange', function() {

        var state = History.getState();

        switch (state.data.type) {
            case 'chat':
                Chat.load(state.url);
                break;
        }
    });
});