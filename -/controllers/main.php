<?php namespace std\fieldControls\txt\controllers;

class Main extends \Controller
{
    /**
     * @var \ewma\Data\Cell
     */
    private $cell;

    public function __create()
    {
        $this->cell = $this->unpackCell();

        $this->instance_($this->cell->xpack());

        $this->dmap('|' . $this->cell->underscoreField(), 'config');
    }

    public function reload()
    {
        $this->jquery('|')->replace($this->view());
    }

    public function view()
    {
        $v = $this->v('|');

        $svc = \std\fieldControls\txt\svc($this->data('config'));

        list($content, $value) = $svc->getContent($this->cell);

        $v->assign([
                       'CONTENT' => $this->c('\std\ui txt:view', [
                           'path'                       => '>xhr:update',
                           'data'                       => [
                               'cell' => $this->cell->xpack()
                           ],
                           'class'                      => 'txt ' . (null === $this->cell->value() ? 'null' : ''),
                           'fitInputToClosest'          => '.cell',
                           'editTriggerClosestSelector' => '.cell',
                           'content'                    => $content,
                           'contentOnInit'              => $value,
                           'mask'                       => $svc->mask
                       ])
                   ]);

        $this->css();

        if (!$this->app->html->containerAdded($this->_nodeId())) {
            $this->app->html->addContainer($this->_nodeId(), $this->c('eventsDispatcher:view'));
        }

        return $v;
    }
}
