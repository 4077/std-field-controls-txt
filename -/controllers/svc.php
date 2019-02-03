<?php namespace std\fieldControls\txt\controllers;

class Svc extends \Controller
{
    public function getContent($product, $field)
    {
        $fieldData = $this->data();

        $type = $fieldData['type'];

        $value = $product->{$field};

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
            $decimals = !empty($fieldData['decimals']) ? $fieldData['decimals'] : 2;

            if (null === $value) {
                $content = 'null';
                $contentOnInit = '';
            } else {
                if (!empty($fieldData['trim_zeros'])) {
                    $content = trim_zeros(number_format__($value, $decimals));
                    $contentOnInit = trim_zeros($value);
                } else {
                    $content = number_format__($value, $decimals);
                    $contentOnInit = $value;
                }
            }
        }

        return [$content, $contentOnInit];
    }

    public function parseValue($field, $value)
    {
        $fieldData = $this->data();

        if ($fieldData['type'] == 'string') {
            if (!empty($fieldData['nullable']) && $value === '') {
                $value = null;
            }
        }

        if ($fieldData['type'] == 'integer') {
            if (!empty($fieldData['nullable']) && $value === '') {
                $value = null;
            } else {
                $value = (int)$value;
            }
        }

        if ($fieldData['type'] == 'decimal') {
            if (!empty($fieldData['nullable']) && $value === '') {
                $value = null;
            } else {
                $decimals = !empty($fieldData['decimals']) ? $fieldData['decimals'] : 2;

                $value = \ewma\Data\Formats\Numeric::parseDecimal($value, $decimals);
            }
        }

        return $value;
    }
}
