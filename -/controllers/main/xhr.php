<?php namespace std\fieldControls\txt\controllers\main;

class Xhr extends \Controller
{
    public $allow = self::XHR;

    public function reload()
    {
        if ($cell = $this->unxpackCell()) {
            $this->c('~:reload', [], 'cell');
        }
    }

    public function update()
    {
        if ($cell = $this->unxpackCell()) {
            $this->dmap('~|' . $cell->underscoreField(), 'config');

            $svc = \std\fieldControls\txt\svc($this->data('config'));

            $txt = \std\ui\Txt::value($this);

            $value = $svc->parseValue($txt->value);

            $cell->value($value);

            list($content, $value) = $svc->getContent($cell);

            $txt->response($content, $value);

            pusher()->trigger('std/cell/update', [
                'cell' => $cell->xpack()
            ]);
        }
    }
}
