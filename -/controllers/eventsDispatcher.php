<?php namespace std\fieldControls\txt\controllers;

class EventsDispatcher extends \Controller
{
    public function view()
    {
        pusher()->subscribe();

        $v = $this->v('|');

        $this->widget(':|', [
            '.r'     => [
                'reload' => $this->_p('~xhr:reload')
            ],
            'nodeId' => $this->_nodeId('~')
        ]);

        return $v;
    }
}
