<?php namespace std\fieldControls\txt\controllers;

class Main extends \Controller
{
    private $model;

    private $field;

    public function __create()
    {
        $model = $this->model = $this->data['model'];
        $field = $this->field = $this->data['field'];

        $this->instance_(underscore_cell($model, $field));

        $this->dmap('|' . underscore_field($model, $field), 'data');
    }

    public function reload()
    {
        $this->jquery('|')->replace($this->view());
    }

    public function view()
    {
        $v = $this->v('|');

        $model = $this->model;
        $field = $this->field;

        $svc = \std\fieldControls\txt\svc($this->data('data'));

        list($content, $value) = $svc->getContent($model, $field);

        $v->assign([
                       'CONTENT' => $this->c('\std\ui txt:view', [
                           'path'                       => '>xhr:update',
                           'data'                       => [
                               'cell' => xpack_cell($model, $field)
                           ],
                           'class'                      => 'txt ' . (null === $model->{$field} ? 'null' : ''),
                           'fitInputToClosest'          => '.cell',
                           'editTriggerClosestSelector' => '.cell',
                           'content'                    => $content,
                           'contentOnInit'              => $value
                       ])
                   ]);

        $this->css();

        $this->se(underscore_field($model, $field))->rebind(':reload');

        return $v;
    }
}
