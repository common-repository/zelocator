<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_Ui_Element_Input_RichTextarea extends HC3_Ui_Element_Input_Textarea
{
	protected $el = 'input';
	protected $uiType = 'input/text';
	protected $bold = FALSE;

	public function bold( $set = TRUE )
	{
		$this->bold = $set;
		return $this;
	}

	public function render()
	{
		$wpEditorSettings = array();
		$wpEditorSettings['textarea_name'] = $this->htmlName();

		$rows = $this->getAttr('rows');
		if( $rows ){
			$wpEditorSettings['textarea_rows'] = $rows;
		}

		// stupid wp, it outputs it right away
		ob_start();

		$editorId = $this->htmlId();
		wp_editor(
			$this->value,
			$editorId,
			$wpEditorSettings
			);

		if( 0 )
		{
			$more_js = <<<EOT
<script type="text/javascript">
var str = nts_tinyMCEPreInit.replace(/nts_wp_editor/gi, '$editor_id');
var ajax_tinymce_init = JSON.parse(str);

tinymce.init( ajax_tinymce_init.mceInit['$editor_id'] );
</script>
EOT;

//				_WP_Editors::enqueue_scripts();
//				print_footer_scripts();
//				_WP_Editors::editor_js();
			echo $more_js;
		}

		$out = ob_get_clean();
		return $out;




		$out = $this->htmlFactory->makeElement('input')
			->addAttr('type', 'text' )
			->addAttr('name', $this->htmlName() )
			->addAttr('class', 'hc-field')
			// ->addAttr('class', 'hc-block')
			->addAttr('class', 'hc-full-width')
			;

		if( strlen($this->value) ){
			$out->addAttr('value', $this->value);
		}

		$attr = $this->getAttr();
		foreach( $attr as $k => $v ){
			$out->addAttr( $k, $v );
		}

		$out->addAttr('id', $this->htmlId());

		if( strlen($this->label) ){
			$out
				->addAttr('placeholder', $this->label)
				;
		}

		if( $this->bold ){
			$out
				->addAttr('class', 'hc-fs5')
				;
		}

		if( strlen($this->label) && (! $this->bold) ){
			$label = $this->htmlFactory->makeElement('label', $this->label)
				->addAttr('for', $this->htmlId())
				->addAttr('class', 'hc-fs2')
				;
			$out = $this->htmlFactory->makeList( array($label, $out) );
			// $out = $this->htmlFactory->makeCollection( array($label, $out) );
		}

		return $out;
	}
}