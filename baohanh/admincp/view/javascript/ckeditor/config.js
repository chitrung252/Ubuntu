/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];

	config.removeButtons = 'Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Print,NewPage,Save,Replace,Find,Scayt,SelectAll,BidiLtr,Language,Anchor,Smiley,PageBreak,ShowBlocks,About,Cut,Copy,Paste,PasteText,PasteFromWord,Format,BidiRtl';
	config.skin = 'office';
};

CKEDITOR.on( 'dialogDefinition', function( ev )
   {
      // Take the dialog name and its definition from the event data.
      var dialogName = ev.data.name;
      var dialogDefinition = ev.data.definition;
  
      // Check if the definition is from the dialog we're
      // interested in (the 'image' dialog). This dialog name found using DevTools plugin
      if ( dialogName == 'image' )
      {
         // Remove the 'Link' and 'Advanced' tabs from the 'Image' dialog.
         dialogDefinition.removeContents( 'link' );
         dialogDefinition.removeContents( 'advanced' );
  
         // Get a reference to the 'Image Info' tab.
         var infoTab = dialogDefinition.getContents( 'info' );
  
         // Remove unnecessary widgets/elements from the 'Image Info' tab.         
         infoTab.remove( 'txtHSpace');
         infoTab.remove( 'txtVSpace');
		 infoTab.remove( 'cmbAlign' );
		 //infoTab.remove( 'htmlPreview' );
		 infoTab.remove( 'txtBorder');
      }
   });