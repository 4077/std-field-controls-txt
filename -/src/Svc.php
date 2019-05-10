<?php namespace std\fieldControls\txt;

class Svc
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;

        $this->render();
    }

    public $mask;

    private function render()
    {
        $data = $this->config;

        $type = $data['type'];

        if ($type == 'phone') {
            $this->mask = '+7? (999) 999-99-99';
        }
    }

    public function getContent(\ewma\Data\Cell $cell)
    {
        $config = $this->config;

        $type = $config['type'];

        $value = $cell->value();

        $content = $value;
        $contentOnInit = $value;

        if ($type == 'string') {

        }

        if ($type == 'integer') {
            if (null === $value) {
                $content = 'null';
                $contentOnInit = '';
            }
        }

        if ($type == 'decimal') {
            $decimals = !empty($config['decimals']) ? $config['decimals'] : 2;

            if (null === $value) {
                $content = 'null';
                $contentOnInit = '';
            } else {
                if (!empty($config['trim_zeros'])) {
                    $content = trim_zeros(number_format__($value, $decimals));
                    $contentOnInit = trim_zeros($value);
                } else {
                    $content = number_format__($value, $decimals);
                    $contentOnInit = $value;
                }
            }
        }

        if ($type == 'phone') {
            $content = \ewma\Data\Formats\Phone::format($value, '+7');
            $contentOnInit = $value;
        }

        return [$content, $contentOnInit];
    }

    public function parseValue($value)
    {
        $config = $this->config;

        if ($config['type'] == 'string') {
            if (!empty($config['nullable']) && $value === '') {
                $value = null;
            }
        }

        if ($config['type'] == 'integer') {
            if (!empty($config['nullable']) && $value === '') {
                $value = null;
            } else {
                $value = (int)$value;
            }
        }

        if ($config['type'] == 'decimal') {
            if (!empty($config['nullable']) && $value === '') {
                $value = null;
            } else {
                $decimals = !empty($config['decimals']) ? $config['decimals'] : 2;

                $value = \ewma\Data\Formats\Numeric::parseDecimal($value, $decimals);
            }
        }

        if ($config['type'] == 'phone') {
            $value = \ewma\Data\Formats\Phone::parse($value, 7);
        }

        return $value;
    }
}
