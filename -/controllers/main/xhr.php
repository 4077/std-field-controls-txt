<?php namespace std\fieldControls\txt\controllers\main;

class Xhr extends \Controller
{
    public $allow = self::XHR;

    public function update()
    {
        if ($cell = $this->unxpackCell()) {
            $this->dmap('~|' . $cell->underscoreField(), 'data');

            $svc = \std\fieldControls\txt\svc($this->data('data'));

            $txt = \std\ui\Txt::value($this);

            $value = $svc->parseValue($cell->field, $txt->value);

            $cell->value($value);

            list($content, $value) = $svc->getContent($cell->model, $cell->field);

            $txt->response($content, $value);

            $this->se(underscore_field($cell->model, $cell->field))->trigger([
                                                                                 'model' => $cell->model,
                                                                                 'field' => $cell->field
                                                                             ]);
        }
    }
}
