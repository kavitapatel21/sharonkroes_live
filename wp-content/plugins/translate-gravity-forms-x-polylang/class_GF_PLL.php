<?php

if (!class_exists('GravityFormsPolylang')) :

    class GravityFormsPolylang
    {
        private array $whitelist;
        private array $blacklist;
        private array $registered_strings;
        private array $form;

        public function __construct()
        {
            $this->whitelist = array(
                'title',
                'description',
                'text',
                'content',
                'message',
                'defaultValue',
                'errorMessage',
                'placeholder',
                'label',
                'customLabel',
                'value',
                'subject',
                'checkboxLabel',
                'descriptionPlaceholder'
            );

            $this->blacklist = array();
            $this->registered_strings = array();
        }

        private function isTranslatable($key, $value): bool
        {
            return
                $key &&
                in_array($key, $this->whitelist) &&
                is_string($value) &&
                !in_array($value, $this->registered_strings);
        }

        private function iterateForm(&$value, $key, $callback = null): void
        {
            if (!$callback && is_callable($key)) {
                $callback = $key;
            }

            if (is_array($value) || is_object($value)) {
                foreach ($value as $new_key => &$new_value) {
                    if (!(in_array($new_key, $this->blacklist) && !is_numeric($new_key))) {
                        $this->iterateForm($new_value, $new_key, $callback);
                    }
                }
            } else {
                if ($this->isTranslatable($key, $value)) {
                    $callback($value, $key);
                }
            }
        }

        public function registerStrings(): void
        {
            $page = isset($_GET['page']) ? sanitize_text_field($_GET['page']) : '';
            if (!str_starts_with($page, 'mlang') || !class_exists('GFAPI') || !function_exists('pll_register_string')) {
                return;
            }

            $forms = GFAPI::get_forms();
            foreach ($forms as $form) {
                $this->form = $form;
                $this->registered_strings = array();
                $this->iterateForm($form, function ($value, $key) {
                    $name = 'gfpll'; // todo: suitable naming
                    $group = "Form #{$this->form['id']}: {$this->form['title']}";
                    $multiline = ( 50 < mb_strlen($value) );
                    pll_register_string($name, $value, $group, $multiline);
                    $this->registered_strings[] = $value;
                });
            }
        }

        public function translateStrings($form)
        {
            if (function_exists('pll__')) {
                $this->iterateForm($form, function (&$value, $key) {
                    $value = pll__($value);
                });
            }

            return $form;
        }
    }

endif;
