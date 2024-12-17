/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
//   config.extraPlugins = 'youtube';
   let domainName=window.location.origin;
//   let domainName=window.location.origin+'/dadreeios';
    console.log('domainName');
    console.log(domainName);
  config.filebrowserBrowseUrl =domainName+'/backend-assets/ckeditor/kcfinder/browse.php?opener=ckeditor&type=files';
  console.log(config.filebrowserBrowseUrl);

  config.filebrowserImageBrowseUrl = domainName+'/backend-assets/ckeditor/kcfinder/browse.php?opener=ckeditor&type=images';

  config.filebrowserFlashBrowseUrl = domainName+'/backend-assets/ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash';

  config.filebrowserUploadUrl = domainName+'/backend-assets/ckeditor/kcfinder/upload.php?opener=ckeditor&type=files';

  config.filebrowserImageUploadUrl = domainName+'/backend-assets/ckeditor/kcfinder/upload.php?opener=ckeditor&type=images';

  config.filebrowserFlashUploadUrl = domainName+'/backend-assets/ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash';

  config.filebrowserUploadMethod = 'form';
};

