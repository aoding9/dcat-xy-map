<?php
namespace App\Admin\Extensions\Form;
use Dcat\Admin\Admin;
use Dcat\Admin\Form\Field;
class XyMap  extends Field{
    protected $view = 'admin.xy-map';

    protected $column = [];
    protected $height = '800px';
    protected $bg = '/assets/images/map.png';
    protected $marker = '/assets/images/marker.png';
    public static function requireAssets()
    {
        $js = '/assets/vue.min.js';

        Admin::js($js);
    }
    public function __construct($column, $arguments)
    {
        $this->column['x'] = (string) $column;
        $this->column['y'] = (string) $arguments[0];

        array_shift($arguments);

        $this->label = $this->formatLabel($arguments);

    }

    public function bg(string $bg)
    {
        $this->bg = $bg;
        return $this;
    }
    public function marker(string $marker)
    {
        $this->marker = $marker;
        return $this;
    }
    public function height(string $height)
    {
        $this->height = $height;
        return $this;
    }

    protected function getDefaultElementClass()
    {
        $class = $this->normalizeElementClass($this->column['x']).$this->normalizeElementClass($this->column['y']);

        return [$class, static::NORMAL_CLASS];
    }

    /**
     * Set element class.
     *
     * @param  string|array  $class
     * @param  bool  $normalize
     * @return $this
     */
    public function setElementClass($class, bool $normalize = true)
    {
        if ($normalize) {
            $class = $this->normalizeElementClass($class);
        }

        $strClass = array_merge($class['x'], $class['y']);
        $this->elementClass = $strClass;

        return $this;
    }

    public function render()
    {
        $this->addVariables([
            'height' => $this->height,
            'bg' => $this->bg,
            'marker' => $this->marker,
                            ]);

        return parent::render();
    }


}
