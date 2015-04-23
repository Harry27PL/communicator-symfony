<?php

namespace TwigExtensions;

class Date extends \Twig_Extension
{
    /* @var $translator \Symfony\Component\Translation\Translator */

    private $translator;
    private $environment;
    private $timezone;
    private $dateformat = 0;
    private $timeformat = 0;

    public function __construct($translator)
    {
        $this->translator = $translator;
        $this->timezone = new \DateTimeZone('Europe/Warsaw');
    }

    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    public function getName()
    {
        return 'date';
    }

    public function getFunctions()
    {
        return array(
            'time'          => new \Twig_Function_Method($this, 'time',         array('is_safe' => array('html'))),
            'date'          => new \Twig_Function_Method($this, 'date',         array('is_safe' => array('html'))),
            'datetime'      => new \Twig_Function_Method($this, 'datetime',     array('is_safe' => array('html'))),
            'timeDiff'      => new \Twig_Function_Method($this, 'timeDiff',     array('is_safe' => array('html'))),
            'timeDiffAgo'   => new \Twig_Function_Method($this, 'timeDiffAgo',  array('is_safe' => array('html'))),
            'leftTime'      => new \Twig_Function_Method($this, 'leftTime',     array('is_safe' => array('html'))),
            'leftTimeDays'  => new \Twig_Function_Method($this, 'leftTimeDays', array('is_safe' => array('html'))),
        );
    }

    public function time(\DateTime $d)
    {
        // if stąd że na dev się wywalało po edytowaniu czegoś w twigu
        if ($this->timezone)
            $d->setTimezone($this->timezone);

        return $this->environment->render('date/time.html.twig', array(
            'diff' => $this->timeDiffAgo($d),
            'datetime' => $this->datetime($d),
        ));
    }

    public function date(\DateTime $d)
    {
        if (!$this->dateformat)
            $date = $d->format('j').' '.$this->translator->trans('date.monthGenitive.'.$d->format('n')).' '.$d->format('Y');
        else
            $date = $this->translator->trans('date.monthGenitive.'.$d->format('n')).' '.$d->format('j').' '.$d->format('Y');

        return $date;
    }

    public function datetime(\DateTime $d)
    {
        $date = $this->date($d);

        if (!$this->timeformat)
            $time = $d->format('G:i');
        else
            $time = $d->format('g:i A');

        return $date.', '.$time;
    }

    public function timeDiff(\DateTime $d, $from = null)
    {
        $trans = $this->translator;

        if (!$from)
            $from = new \DateTime();

        $c = $d->diff($from)->days;
        if ($c > 1)
        {
            if ($c < 30) {
                $a = $from;
                if ($d->format('H') > $a->format('H'))
                    $c++;

                return $c.' '.$trans->trans('date.diff.days');
            }

            else {
                $c = round($c/30);
                return $this->odmiana($c, $trans->trans('date.diff.month'), $trans->trans('date.diff.months1'), $trans->trans('date.diff.months2'));
            }
        }
        else
        {
            $c = $d->diff($from);

            if (!$c->h && !$c->days)
            {
                if (!$c->i)
                    return $this->odmiana($c->s, $trans->trans('date.diff.second'), $trans->trans('date.diff.seconds1'), $trans->trans('date.diff.seconds2'));

                else
                    return $this->odmiana($c->i, $trans->trans('date.diff.minute'), $trans->trans('date.diff.minutes1'), $trans->trans('date.diff.minutes2'));
            }
            else
            {
                if (!$c->days)
                    return $this->odmiana($c->h, $trans->trans('date.diff.hour'), $trans->trans('date.diff.hours1'), $trans->trans('date.diff.hours2'));

                elseif ($c->h)
                    return '1 '.$trans->trans('date.diff.day').' '.$c->h.' '.$trans->trans('date.diff.hours');

                else
                    return '1 '.$trans->trans('date.diff.day');
            }
        }
    }

    public function timeDiffAgo(\DateTime $d, $from = null)
    {
        $trans = $this->translator;
        $ago = $trans->trans('date.diff.ago');

        if ($trans->trans('date.diff.agoDir') == 'r')
            return $this->timeDiff($d, $from).' '.$ago;

        return $ago.' '.$this->timeDiff($d, $from);
    }

    public function odmiana($d, $a, $b, $c)
    {
        if ($d == 1)
            return $a;

        elseif ($d > 10 && $d < 20)
            return $d.' '.$b;

        elseif (array_search(substr($d, -1, 1), array(2, 3, 4)) !== false)
            return $d.' '.$c;

        else
            return $d.' '.$b;
    }

    public function leftTime(\DateTime $to, \DateTime $from = null)
    {
        if (!$from)
            $from = new \DateTime();

        return $this->timeDiff($to, $from);
    }

    public function leftTimeDays($days, \DateTime $from)
    {
        $end = clone $from;
        $end->modify('+'.$days.' days');

        $today = new \DateTime();

        if ($today > $end)
            $end = clone $today;

        return $this->timeDiff($end, $today);
    }
}