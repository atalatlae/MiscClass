<?php

namespace MiscClass;

class HTMLForm
{
	private $action;
	private $method;
	private $encType;
	private $attrs;
	private $fields;

	public function __construct($action = '', $method = '', $encType = '', $attrs = array()) {
		$this->action = ($action)?$action:'';
		$this->method = ($method)?$method:'';
		$this->encType = ($encType)?$encType:'';
		$this->attrs = (is_array($attrs))?$attrs:array();
	}

	public function render() {
		return sprintf('<form method="%s" action="%s" %s %s>'
			.'%s'
			.'</form>',
			$this->method,
			$this->action,
			$this->renderEncType(),
			$this->renderAttrs($this->attrs),
			$this->renderFields()
		);
	}

	public function addField($label, $name, $type, $value, $attrs = array()) {
		$this->fields[] = array(
			'label' => $label,
			'name' => $name,
			'type' => $type,
			'value' => $value,
			'attrs' => $attrs,
		);
	}

	private function renderEncType() {
		return ($this->encType)?'enctype="'.$this->encType.'"':'';
	}

	private function renderAttrs(Array $attrs) {
		$r = '';
		foreach ($attrs as $k => $v) {
			$r .= "$k=\"$v\" ";
		}
		return $r;
	}

	private function renderFields() {
		$r = '';
		foreach ($this->fields as $f) {


			switch ($f['type']){
				case 'text':
				case 'file':
				case 'password':
					$r .= sprintf('<p><label>%s%s</label></p>',
						$f['label'],
						$this->renderInput($f['type'], $f['name'], $f['value'], $f['attrs'])
					);
					break;
				case 'textarea':
					$r .= sprintf('<p><label>%s%s</label></p>',
						$f['label'],
						$this->renderTextArea($f['name'], $f['value'], $f['attrs'])
					);
					break;
				case 'select':
					$r .= sprintf('<p><label>%s%s</label></p>',
						$f['label'],
						$this->renderSelect($f['name'], $f['value'], $f['attrs'])
					);
					break;
				case 'radio':
					$r .= sprintf('<fieldset><legend>%s</legend>%s</fieldset>',
						$f['label'],
						$this->renderRadio($f['name'], $f['value'], $f['attrs'])
					);
					break;
				case 'checkbox':
					$r .= sprintf('<fieldset><legend>%s</legend>%s</fieldset>',
						$f['label'],
						$this->renderCheckbox($f['name'], $f['value'], $f['attrs'])
					);
					break;
				case 'submit':
					$r .= sprintf('<p>%s</p>',
						$this->renderInput($f['type'], $f['name'], $f['value'], $f['attrs'])
					);
					break;
			}
		}
		return $r;
	}


	private function renderInput($type, $name, $value, $attrs) {
		$r = sprintf('<input type="%s" name="%s" value="%s" %s>',
			$type,
			$name,
			$value,
			$this->renderAttrs($attrs)
		);
		return $r;
	}

	private function renderTextArea($name, $value, $attrs) {
		$r = sprintf('<textarea name="%s" %s>%s</textarea>',
			$name,
			$this->renderAttrs($attrs),
			$value
		);
		return $r;
	}

	private function renderSelect($name, Array $value, $attrs) {
		$r = sprintf("<select name=\"%s\" %s>%s"
			.'</select>',
			$name,
			$this->renderAttrs($attrs),
			$this->renderOptions($value)
		);

		return $r;
	}

	private function renderOptions(Array $options) {
        $r = '';
		foreach($options as $k => $v) {
			if (!is_array($v)) {
				$r .= sprintf('<option value="%s">%s</option>', $k, $v);
			}
		}

		return $r;
	}

	private function renderRadio($name, $values, $attrs) {
		$r = '<ul>';
		foreach($values as $k => $v) {
			$r .= sprintf('<li><label><input type="radio" name="%s" value="%s">%s</label></li>', $name, $k, $v);
		}
		$r .= '</ul>';
		return $r;
	}

	private function renderCheckbox($name, $values, $attrs) {
		$r = '<ul>';

		foreach($values as $k => $v) {
			$r .= sprintf('<li><label><input type="checkbox" name="%s" value="%s">%s</label></li>', $name.'_'.$k, $k, $v);
		}
		$r .= '</ul>';
		return $r;
	}
}
