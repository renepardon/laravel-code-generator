<?php

namespace Renepardon\CodeGenerator\Support;

use Illuminate\Support\Arr;
use Illuminate\Translation\Translator;

class RenepardonTranslator extends Translator
{
    /**
     * Adds a new instance of lcg_translator to the IoC container,
     *
     * @return \Renepardon\CodeGenerator\Support\RenepardonTranslator
     */
    public static function getTranslator()
    {
        $translator = app('translator');

        app()->singleton('lcg_translator', function ($app) use ($translator) {
            $trans = new RenepardonTranslator($translator->getLoader(), $translator->getLocale());

            $trans->setFallback($translator->getFallback());

            return $trans;
        });

        return app('lcg_translator');
    }

    /**
     * Add translation lines to the given locale.
     *
     * @param  array  $lines
     * @param  string $locale
     * @param  string $namespace
     *
     * @return void
     */
    public function addLines(array $lines, $locale, $namespace = '*')
    {
        foreach ($lines as $key => $value) {
            list($group, $item) = explode('.', $key, 2);
            Arr::set($this->loaded, "$namespace.$group.$locale.$item", $value);
        }
    }
}
