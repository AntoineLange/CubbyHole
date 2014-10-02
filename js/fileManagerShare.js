var item = function (type, name, path, size, id, exta, lastMod) {
	this.path = path;
	this.type = type;
	this.name = name;
	this.size = size;
	this.id = id;
	this.exta = exta.toLowerCase();
	this.lastMod = lastMod;
	
	this.getSize = function () {
		if (this.size < 1000000) {
		    return Math.ceil(this.size / 1000) + ' KB';
		} else {
			return Math.ceil(this.size / 1000000) + ' MB';
		}
	};
	
	this.getExt = function () {
		return this.exta;
	};
	
	this.getLastMod = function () {
		return this.lastMod;
	};
	
	this.isPicture = function(){
		return typeof(ext_pictures[this.exta]) != 'undefined';
	};
	
	this.isEditable = function(){
		return typeof(ext_editables[this.exta]) != 'undefined';
	};
	
	this.isArchive = function(){
		return typeof(ext_arhives[this.exta]) != 'undefined';
	};
	
	this.getType = function(){
		type = 'unknown';
		if (this.isPicture()) {
			type = 'picture';
		} else if (this.isEditable()) {
			type = 'editable';
		} else if (this.isArchive()) {
			type = 'archive';
		}
		return type;
	};
};

function get_cur_item(id){
	result = null;
	if (typeof(cur_items[id]) != 'undefined') {
		result = cur_items[id];
	}
	return result;
}

//Affiche l'image de chargement
function showLoading() {
	jQuery("#dirContent").html('<div class="loadingDiv">&nbsp;</div>');
}

function getSelectedItemsPath() {
	var arr = new Array();
	for (var x in clipboard) {
		arr.push(clipboard[x].path);
	}
	if (arr.length > 0) {
	    return arr.join(',,,');
	}
	return null;
}

function getSelectedItems(){
	var arr = new Array();
	jQuery("#dirsFilesTable div.rowSelected").each(function(){
		var id = jQuery(this).attr('rel');
		if (typeof(cur_items[id]) != 'undefined') {
		    arr.push(cur_items[id].name);
		}
	});
	if (arr.length > 0) {
	    return arr.join(',,,');
	}
	return null;
}

function getTotalSpace() {
	var totalSpace = 0;
	jQuery("div.file").each(function() {
		var id = jQuery(this).attr('rel');
		if (typeof(cur_items[id]) != 'undefined') {
			fileSpace = parseInt(cur_items[id].size);
			totalSpace = totalSpace + fileSpace;
		}
	});
	return Math.ceil(totalSpace / 1000000) + ' MB';
}

function checkResponce(data) {
	if (typeof(data) == 'undefined') {
		return;
	}
	if (data.substr(0 , 9) == '{result: ') {
		eval('var my_responce = ' + data + ';');
		if (typeof(my_responce.result != 'undefined')) {
		  if (my_responce.result == '1') {
			  //alert('OK');
		  } else if (typeof(my_responce.gserror) != 'undefined') {
			  alert(my_responce.gserror);
		  } else {
			  alert('Error');
		  }
		}
		delete my_responce;
	}
}

function storeSelectedItems(){
    clipboard = new Array();
    jQuery("#dirsFilesTable div.rowSelected").each(function(){
		var id = jQuery(this).attr('rel');
        if (typeof(cur_items[id]) != 'undefined') {
		    clipboard.push(cur_items[id]);
        } else {
        	alert('Uknown item selected');
        }
	});
}

function showClipboardContent(){
    var diva = jQuery('#clipboardContent');
    var divaHtml = '';
    for (var xx in clipboard) {
    	var clasa = 'file';
    	if (clipboard[xx].getExt() == 'dir') {
    		clasa = 'directory';
    	}
    	divaHtml += '<div class="'+ clasa +'">&nbsp;&nbsp;&nbsp;' + clipboard[xx].path + '<div>';
    }
    diva.html(divaHtml);
    diva.dialog({title: 'Clipboard', modal: true, buttons: {
    	 "Vider": function() { 
    		  clipboard = new Array(); jQuery('#clipboardContent').html(''); jQuery("#clipBoard").html('0 items');
    		  jQuery(this).dialog('close');
    		  }
          }
    });
	return false;
}

function makeUrl(root, params){
	if (root.indexOf('?') != -1) {
		return root + '&' + params;
	} else {
		return root + '?' + params;
	}
}

//Fonction allant chercher les traductions de chaque éléments dans le fichier de langues
function getTranslation(lg, code){
	result = null;
	if (typeof(gs_filemanager_languages[lg]) != 'undefined') {
		if (typeof(gs_filemanager_languages[lg][code]) != 'undefined') {
			result = gs_filemanager_languages[lg][code];
		}
	}
	return result;
}

var cur_items =  new Array();

var clipboard = new Array();

var ext_editables = new Array();
ext_editables['txt'] = '1';
ext_editables['php'] = '1';
ext_editables['doc'] = '1';
ext_editables['js'] = '1';
ext_editables['html'] = '1';
ext_editables['htm'] = '1';
ext_editables['rtf'] = '1';
ext_editables['css'] = '1';
ext_editables['java'] = '1';
ext_editables['asp'] = '1';
ext_editables['xml'] = '1';
ext_editables['xls'] = '1';
ext_editables['sql'] = '1';
ext_editables['log'] = '1';

var ext_pictures = new Array();
ext_pictures['png'] = '1';
ext_pictures['jpg'] = '1';
ext_pictures['jpeg'] = '1';
ext_pictures['gif'] = '1';
ext_pictures['pdf'] = '1';
ext_pictures['ico'] = '1';

var ext_arhives = new Array();
ext_arhives['zip'] = '1';

var gs_forbitten_ext_mapping = new Array();
gs_forbitten_ext_mapping['editable'] = '15,16,17,23';
gs_forbitten_ext_mapping['picture'] = '12,18,23';
gs_forbitten_ext_mapping['unknown'] = '12,15,16,17,18,23';
gs_forbitten_ext_mapping['archive'] = '12,15,16,17,18,19';

if (jQuery) (function(jQuery){
	
	jQuery.extend(jQuery.fn, {
		fileManagerShare: function(o) {
			if( !o ) var o = {};
			if( o.root == undefined ) o.root = '/';
			if( o.language == undefined ) o.language = 'fr';
			if( o.script == undefined ) o.script = 'lib/fileManagerShare.php';
			if( o.expandSpeed == undefined ) o.expandSpeed= 500;
			if( o.collapseSpeed == undefined ) o.collapseSpeed= 500;
			if( o.expandEasing == undefined ) o.expandEasing = null;
			if( o.collapseEasing == undefined ) o.collapseEasing = null;
			if( o.loadMessage == undefined ) o.loadMessage = 'Loading...';
			

			//Construction du menu des boutons d'actions sur les items
			var menuHtml = '<div class=\'headDiv\'>';
			menuHtml += '<span class=\'btn btn-info\'> ' + getTranslation(o.language, 1)+ ' : <span id=\'curDir\'></span> </span>';
			menuHtml += '<a href=\'javascript: void(0);\' onClick=\'return showClipboardContent();\' class=\'btn btn-info clipboard\'>' + getTranslation(o.language, 2)+ '  <span id=\'clipBoard\'>0 items</span></a>';
			menuHtml += '</div>';
			
			menuHtml += '<div class=\'btn-group \'>'; // headButtons
			menuHtml += '<a id="newFileButton" class=\'btn btn-default\'>' + getTranslation(o.language, 4)+ '</a>';
			menuHtml += '<a id="newDirButton" class=\'btn btn-default\'>' + getTranslation(o.language, 5)+ '</a>';
			menuHtml += '<a id="pasteButton" class=\'btn btn-default\'>' + getTranslation(o.language, 6)+ '</a>';
			menuHtml += '<a id="selectAllButton" class=\'btn btn-default\'>' + getTranslation(o.language, 23)+ '</a>';
			menuHtml += '<a id="deselectButton" class=\'btn btn-default\'>' + getTranslation(o.language, 24)+ '</a>';
			menuHtml += '<a id="invertSelectButton" class=\'btn btn-default\'>' + getTranslation(o.language, 25)+ '</a>';
			menuHtml += '</div>';
			
			menuHtml += '<br/><span class=\'totalSpace\'></span>&nbsp;';

			//Construction de la variable HTML principale
			var wrapperHtml = '<div class=\'contentMenu\'>';
			//On ajoute le menu
			wrapperHtml += menuHtml;
			wrapperHtml += '</div>';
			//div de arborescence + fichiers
			wrapperHtml += '<div class=\'dirContent\'>';
			//div arborescence
			wrapperHtml += '<div id=\'dirList\' class=\'dirList\' onClick="jQuery(this).doGSAction({action: 21})"></div>';

			//div contenant les fichiers
			wrapperHtml    += '<div id=\'dirContent\' class=\'dirContentFiles\'></div>';
			wrapperHtml    += '<div id="dragAnDropHandler"><p>Drag & Drop Files Here</p></div>';
			wrapperHtml    += '</div></div>';
			wrapperHtml	   += '<div class="previewFilesName">Details</div>';
			wrapperHtml	   += '<div class="previewContent">';
			wrapperHtml	   += '<div class="previewPic"></div>';
			wrapperHtml	   +=  '<div class="previewInfos"><div class="previewHeader">Infos :</div><div class="previewInfoFileDir"></div></div>';
			wrapperHtml	   +=  '</div>';
			
			var contexMenus = '<ul id="fileContextMenu" class="contextMenu">';
			contexMenus += '<li class="edit"><a href="#edit">' + getTranslation(o.language, 11)+ '</a>';
			contexMenus += '   <ul class="contextMenu subContextMenu">';
			contexMenus += '     <li class="notepad"><a href="#notepad" rel="12">' + getTranslation(o.language, 12)+ '</a></li>';
			contexMenus += '   </ul>';
			contexMenus += '</li>';
			contexMenus += '<li class="copy separator"><a href="#Copy" rel="7">' + getTranslation(o.language, 14)+ '</a></li>';
			contexMenus += '<li class="cut"><a href="#Cut" rel="8">' + getTranslation(o.language, 15)+ '</a></li>';
			contexMenus += '<li class="rename"><a href="#Rename" rel="10">' + getTranslation(o.language, 16)+ '</a></li>';
			contexMenus += '<li class="rename"><a href="#Copy As" rel="13">' + getTranslation(o.language, 17)+ '</a></li>';
			contexMenus += '<li class="zip"><a href="#zip" rel="19">' + getTranslation(o.language, 40)+ '</a></li>';
			contexMenus += '<li class="zip"><a href="#zip" rel="23">' + getTranslation(o.language, 42)+ '</a></li>';
			contexMenus += '<li class="download separator"><a href="#Download" rel="11">' + getTranslation(o.language, 18)+ '</a></li>';
			contexMenus += '<li class="download"><a href="#Download" rel="31">URL téléchargement</a></li>';
			contexMenus += '<li class="delete"><a href="#Delete" rel="6">' + getTranslation(o.language, 19)+ '</a></li>';
			contexMenus += '</ul>';
            
			contexMenus += '<ul id="gsDirMenu" class="contextMenu">';
			contexMenus += '<li class="directorymenu"><a href="#Open" rel="5">' + getTranslation(o.language, 20)+ '</a></li>';
			contexMenus += '<li class="copy separator"><a href="#Copy" rel="7">' + getTranslation(o.language, 14)+ '</a></li>';
			contexMenus += '<li class="cut"><a href="#Cut" rel="8">' + getTranslation(o.language, 15)+ '</a></li>';
			contexMenus += '<li class="rename"><a href="#Rename" rel="10">' + getTranslation(o.language, 16)+ '</a></li>';
			contexMenus += '<li class="zip"><a href="#zip" rel="19">' + getTranslation(o.language, 39)+ '</a></li>';
			contexMenus += '<li class="zip"><a href="#zip" rel="23">' + getTranslation(o.language, 42)+ '</a></li>';
			contexMenus += '<li class="delete"><a href="#Delete" rel="4">' + getTranslation(o.language, 19)+ '</a></li>';
			contexMenus += '</ul>';
			
			contexMenus += '<ul id="gsContentMenu" class="contextMenu">';
			contexMenus += '<li class="paste separator"><a href="#Paste" rel="9">' + getTranslation(o.language, 6)+ '</a></li>';
			contexMenus += '<li class="newfile separator"><a href="#New File" rel="2">' + getTranslation(o.language, 4)+ '</a></li>';
			contexMenus += '<li class="newdir"><a href="#New Directory" rel="3">' + getTranslation(o.language, 5)+ '</a></li>';
			contexMenus += '<li class="uploadfolder separator"><a href="#Upload" rel="14">' + getTranslation(o.language, 3)+ '</a></li>';
			contexMenus += '<li class="selection separator"><a href="#Select All" rel="20">' + getTranslation(o.language, 23)+ '</a></li>';
			contexMenus += '<li class="selection"><a href="#>Deselect all" rel="21">' + getTranslation(o.language, 24)+ '</a></li>';
			contexMenus += '<li class="selection"><a href="#Invert selection" rel="22">' + getTranslation(o.language, 25)+ '</a></li>';
			contexMenus += '</ul>';
			
			wrapperHtml    += contexMenus;
			
			var hiddenElements = '<div id=\'clipboardContent\' style=\'display: none\'></div>';
			hiddenElements += '<div id=\'notepadEdit\' style=\'display: none\'></div>';
			hiddenElements += '<div id=\'dialogUploadFiles\' style=\'display: none; position: relative;\'>';
			hiddenElements += '<form action="' + o.script +'" id="uploadForm" enctype="multipart/form-data" method="post"><input type="hidden" name="opt" value="11"><input type="hidden" name="dir" value="">';
			hiddenElements +=  '<div style="padding: 20px; font-size: 14px; padding-left: 0px;"><a id="uploadAddField" class=\'dirContentButton\'>&nbsp;' + getTranslation(o.language, 45)+ '&nbsp;</a></div>';
			hiddenElements +=  '<div class="fileinputs" id="gs_uploadsFiledsHolder"></div></form>';
			hiddenElements += '</div>';
			wrapperHtml += hiddenElements;
			jQuery(this).html(wrapperHtml);

			jQuery('#dirContent').contextMenu({
				menu: 'gsContentMenu',
				addSelectedClass: false
			},
				function(action, el, pos) {
				    jQuery(el).doGSAction({action: action, script: o.script, type: 'context', lg: o.language});
			});
			
			jQuery('#uploadButton').click(function (e){
				e.stopPropagation();
				jQuery('#gs_uploadsFiledsHolder').html('');
				jQuery('#uploadAddField').click();
				jQuery(this).doGSAction({action: 14, script:  o.script, type: 'file', lg: o.language});
			});
			
			jQuery('#newFileButton').click(function (e){
				e.stopPropagation();
				jQuery(this).doGSAction({action: 2, script: o.script, type: 'file', lg: o.language});		
			});
			
			jQuery('#newDirButton').click(function (e){
				e.stopPropagation();
				jQuery(this).doGSAction({action: 3, script: o.script, type: 'dir', lg: o.language});
			});
			
			jQuery('#pasteButton').click(function (e){
				e.stopPropagation();
				jQuery(this).doGSAction({script: o.script, action: 9, lg: o.language});
			});
			
			jQuery('#selectAllButton').click(function (e){
				e.stopPropagation();
				jQuery(this).doGSAction({action: 20, script: o.script, type: 'context', lg: o.language});
			});
			
			jQuery('#deselectButton').click(function (e){
				e.stopPropagation();
				jQuery(this).doGSAction({action: 21, script: o.script, type: 'context', lg: o.language});
			});
			
			jQuery('#invertSelectButton').click(function (e){
				e.stopPropagation();
				return jQuery(this).doGSAction({action: 22, script: o.script, type: 'context', lg: o.language});
			});
			
			jQuery('#uploadAddField').click(function (e){
				e.stopPropagation();
				e.preventDefault();
				var uploadsFieldsHolder = jQuery('#gs_uploadsFiledsHolder');
				var uploadsFieldsLength = jQuery('#gs_uploadsFiledsHolder input').length;
				uploadsFieldsHolder.append('<div><a onClick="jQuery(this).parent().remove();" style="font-size: 12px" class=\'dirContentButton\'>&nbsp;' + getTranslation(o.language, 46)+ '&nbsp;</a> <input type="file" name="filename_' + uploadsFieldsLength + '" size="30"/></div>');
			});
			
			/*jQuery('#uploadForm').ajaxForm({
				    beforeSubmit: function () {
				    	jQuery('#dialogUploadFiles').append('<div class="loadingDiv">&nbsp;</div>');
					}, 
					success: function (responseText, statusText, xhr, $form) {
						checkResponce(responseText);
						jQuery('#'+jQuery("#curDir").attr('rel')).trigger('click');
						jQuery('#dialogUploadFiles').find('div.loadingDiv').remove(); 
					},
					dataType: 'script'
			});*/

			function manageMenu(srcElement, menu){
				if (srcElement.attr('rel') == 'up') {
					return false;
				}
				gs_item = cur_items[srcElement.attr('rel')];
				type = gs_item.getType();			
				if (typeof(gs_forbitten_ext_mapping[type]) != 'undefined') {
					menu.disableContextMenuItems(gs_forbitten_ext_mapping[type]);
				}
				return true;
			}
			
			function showFiles(files) {
				var fileshtml = '';
				if (files.length > 0) {
					var lastParent = jQuery('#' + jQuery("#curDir").attr('rel')).parent().parent().parent().children('a');
					if(lastParent.length > 0) {
						var countFile = gsdirs.length + 2;
					} else {
						var countFile = gsdirs.length + 1;
					}
					for (var num in files) {
						var curItem = files[num];
						cur_items[curItem.id] = curItem;
						var extensionCurItem = curItem.getExt();
						var longExtensionCurItem = fileExtensions[o.language][extensionCurItem];
						fileshtml += "<tr id=" + countFile + "><td><div class='file item directory_info ext_" + curItem.getExt() + "' rel=\'" + curItem.id + "\'>" + curItem.name + "</div></td>";
						fileshtml += "<td><span class=\'file_ext_name\'>" + longExtensionCurItem + "</span></td><td>" + curItem.getSize() + "</td><td>"+curItem.getLastMod()+"</td></tr>";
						countFile++;
					}
				}
				return fileshtml;
			}
			
			function showDirs(dirs) {
				var fileshtml = '';
				//On cherche un répertoire parent
				var lastParent = jQuery('#' + jQuery("#curDir").attr('rel')).parent().parent().parent().children('a');
				//Si on a un repertoire parent
				if (lastParent.length > 0) {
				    fileshtml += "<tr id='1'><td><div class='directory directory_info item' rel=\'up\'><a href='javascript:void(0)' ondblclick=\"jQuery('#" + jQuery("#curDir").attr('rel')+ "').parent().parent().parent().children('a').trigger('click'); return false\"> ..</a></div></td><td>Retour</td></tr>";
				}
				if (dirs.length > 0) {
					if(lastParent.length > 0) {
						var countDir = 2;
					} else {
						var countDir = 1;
					}
					for (var numf in dirs) {
						var curItem = dirs[numf];
						cur_items[curItem.id] = curItem;
						fileshtml += "<tr id=" + countDir + "><td><div class='directory directory_info item' rel=\'" + curItem.id + "\'><a href='javascript:void(0)' ondblclick=\"jQuery('#"+curItem.id+"').trigger('click'); return false\">" + curItem.name + "</a></div></td>";
						fileshtml += "<td>Dossier</td><td></td><td>"+curItem.getLastMod()+"</td></tr>";
						countDir++;
					}
				}
                return fileshtml;
			}

			function sendFileToServer(formData,status)
			{
			    var uploadURL = "./lib/fileManagerShare.php"; //Upload URL
			    var extraData ={}; //Extra Data.
			    var jqXHR=$.ajax({
			            xhr: function() {
			            var xhrobj = $.ajaxSettings.xhr();
			            if (xhrobj.upload) {
			                    xhrobj.upload.addEventListener('progress', function(event) {
			                        var percent = 0;
			                        var position = event.loaded || event.position;
			                        var total = event.total;
			                        if (event.lengthComputable) {
			                            percent = Math.ceil(position / total * 100);
			                        }
			                        //Set progress
			                        status.setProgress(percent);
			                    }, false);
			                }
			            return xhrobj;
			        },
			    url: uploadURL,
			    type: "POST",
			    contentType:false,
			    processData: false,
			        cache: false,
			        data: formData,
			        success: function(data){
			            status.setProgress(100);
			            $("#status1").append("File upload Done<br>");
			            var selectedFiles = getSelectedItems();
						//dataForSend = {opt: 4, files: encodeURIComponent(selectedFiles), dir: curDir};
						showLoading();
						//dataForSend.dir = encodeURIComponent(dataForSend.dir);
						$.ajax({
							type: 'POST',
							url: o.script,
							data: jQuery.param('') + '&time='+ new Date().getTime(),
							dataType: 'text',
							contentType : 'application/x-www-form-urlencoded;charset=utf-8',
								beforeSend : function(xhr) {
							   		xhr.setRequestHeader('Accept', "text/html; charset=utf-8");
							},
							success: function(data) {
								jQuery('#'+jQuery("#curDir").attr('rel')).trigger('click');
						}});      
			        }
			    }); 
			 
			    status.setAbort(jqXHR);
			}
			 
			var rowCount=0;
			function createStatusbar(obj)
			{
			     rowCount++;
			     var row="odd";
			     if(rowCount %2 ==0) row ="even";
			     this.statusbar = $("<div class='statusbar "+row+"'></div>");
			     this.filename = $("<div class='filename'></div>").appendTo(this.statusbar);
			     this.size = $("<div class='filesize'></div>").appendTo(this.statusbar);
			     this.progressBar = $("<div class='progressBar'><div></div></div>").appendTo(this.statusbar);
			     this.abort = $("<div class='abort'>Annuler</div>").appendTo(this.statusbar);
			     obj.after(this.statusbar);
			 
			    this.setFileNameSize = function(name,size)
			    {
			        var sizeStr="";
			        var sizeKB = size/1024;
			        if(parseInt(sizeKB) > 1024)
			        {
			            var sizeMB = sizeKB/1024;
			            sizeStr = sizeMB.toFixed(2)+" MB";
			        }
			        else
			        {
			            sizeStr = sizeKB.toFixed(2)+" KB";
			        }
			 
			        this.filename.html(name);
			        this.size.html(sizeStr);
			    }
			    this.setProgress = function(progress)
			    {       
			        var progressBarWidth =progress*this.progressBar.width()/ 100;  
			        this.progressBar.find('div').animate({ width: progressBarWidth }, 10).html(progress + "% ");
			        if(parseInt(progress) >= 100)
			        {
			            this.abort.hide();
			        }
			    }
			    this.setAbort = function(jqxhr)
			    {
			        var sb = this.statusbar;
			        this.abort.click(function()
			        {
			            jqxhr.abort();
			            sb.hide();
			        });
			    }
			}

			function handleFileUpload(files,obj)
			{
			   for (var i = 0; i < files.length; i++) 
			   {
			        var fd = new FormData();
			        fd.append('file', files[i]);
			 
			        var status = new createStatusbar(obj); //Using this we can set progress.
			        status.setFileNameSize(files[i].name,files[i].size);
			        sendFileToServer(fd,status);
			 
			   }
			}

			$(document).ready(function() {
			  var obj = $("#dragAnDropHandler");
			  obj.on('dragenter', function (e) 
			  {
			      e.stopPropagation();
			      e.preventDefault();
			      $(this).css('border', '1px solid #0B85A1');
			  });
			  obj.on('dragover', function (e) 
			  {
			       e.stopPropagation();
			       e.preventDefault();
			  });
			  obj.on('drop', function (e) 
			  {
			   
			       $(this).css('border', '1px dotted #0B85A1');
			       e.preventDefault();
			       var files = e.originalEvent.dataTransfer.files;
			   
			       //We need to send dropped files to Server
			       handleFileUpload(files,obj);
			  });
			  $(document).on('dragenter', function (e) 
			  {
			      e.stopPropagation();
			      e.preventDefault();
			  });
			  $(document).on('dragover', function (e) 
			  {
			    e.stopPropagation();
			    e.preventDefault();
			    obj.css('border', '1px dotted #0B85A1');
			  });
			  $(document).on('drop', function (e) 
			  {
			      e.stopPropagation();
			      e.preventDefault();
			  });
			});
			
			function showContent(dirs, files) {
				var dirshtml = showDirs(dirs);
				var fileshtml = showFiles(files);
				var tableheader = '<table class=\'dirsFilesTable\' id="dirsFilesTable"><tr><th>' + getTranslation(o.language, 7)+ '</th><th width=\'20%\'>' + getTranslation(o.language, 8)+ '</th><th width=\'10%\'>' + getTranslation(o.language, 9)+ '</th><th width=\'20%\'>' + getTranslation(o.language, 10)+ '</th></tr>';
				jQuery('#dirContent').html(tableheader + dirshtml + fileshtml + "</table>");
				var totalSpacehtml = getTotalSpace();
				jQuery('.totalSpace').html("Stockage total : <font style=\'font-size: 15px;color:#357ebd;font-weight:bold\' >" + totalSpacehtml + "</font>");


				jQuery('div.file').contextMenu({
					menu: 'fileContextMenu'
				},
				function(action, el, pos) {
					jQuery(el).doGSAction({action: action, script: o.script, type: 'file', lg: o.language});
				},
				manageMenu);
				
				$(function(){
					jQuery('table.dirsFilesTable tr').find('div.item').bind('click', function(e) {
					    e.preventDefault();
					    var cur_element = jQuery(this);
					    var rel = jQuery(this).attr('rel');

						if (rel != 'up') {
						    // Detecting ctrl (windows) / meta (mac) key.
						    if (e.ctrlKey || e.metaKey) {
						        if (cur_element.hasClass('rowSelected')) {
						        	cur_element.removeClass('rowSelected');
						        } else {
						        	cur_element.addClass('rowSelected');
						        }
						    }
						    // Detecting shift key
						    else if (e.shiftKey) {
						        // Id du premier élément sélectionné
					    		var currentSelectedIndex = parseInt($('div.rowSelected').parent().parent().attr('id'));
					    		
						        // id de l'élément shift+click
						        var selectedElementIndex = parseInt(jQuery(this).parent().parent().attr('id'));

						        // Sélection entre les deux
						        if (currentSelectedIndex < selectedElementIndex) {
						            for (var indexOfRows = currentSelectedIndex; indexOfRows <= selectedElementIndex; indexOfRows++) {
						                $('div.item').eq(indexOfRows - 1).addClass('rowSelected');
						            }
						        } else {
						            for (var indexOfRows = selectedElementIndex; indexOfRows <= currentSelectedIndex; indexOfRows++) {
						                $('div.item').eq(indexOfRows - 1).addClass('rowSelected');
						            }
						        }
						    } else {
								$('div.item').removeClass('rowSelected');
								cur_element.addClass('rowSelected');
						    }
						}
						jQuery(".contextMenu").hide();

						//Au clic d'un item, affiche son nom dans le details
						$('div.previewFilesName').html($(cur_element).text());
						var selectObject = get_cur_item(jQuery(this).attr('rel'));

						//Si cest un dossier
						if(selectObject.type == '2') {
							$('div.previewPic').html('<img class="imgDetails" src="images/filemanager/ext/folder.png" alt="'+selectObject.name+'">');
							$('div.previewInfoFileDir').html('<p class="contentInfo">Nom : '+selectObject.name+'</p>');
							$('div.previewInfoFileDir').append('<p class="contentInfo">Type : Dossier</p>');
							$('div.previewInfoFileDir').append('<p class="contentInfo">Modif. le : '+selectObject.lastMod+'</p>');
						//Si cest un fichier
						} else {
							var extensionSO = selectObject.getExt();
							var longExtensionSO = fileExtensions[o.language][extensionSO];
							//
							if(extensionSO == 'pdf') {
								$('div.previewPic').html('<img class="imgDetails" src="images/filemanager/ext/pdf.png" alt="'+selectObject.name+'">');
							} else if(selectObject.isPicture()) {
								jQuery("div.previewPic").html('<div class="loadingDiv">&nbsp;</div>');
								$('div.previewPic').html('<img class="imgDetails" src="documents/'+sessIdUser+'/'+selectObject.path+'" alt="'+selectObject.name+'">');
							} else {
								$('div.previewPic').html('<img class="imgDetails" src="images/filemanager/ext/'+selectObject.getExt()+'.png" alt="'+selectObject.name+'">');
							}
							$('div.previewInfoFileDir').html('<p class="contentInfo">Nom : '+selectObject.name+'</p>');
							$('div.previewInfoFileDir').append('<p class="contentInfo">Type : '+longExtensionSO+'</p>');
							$('div.previewInfoFileDir').append('<p class="contentInfo">Taille : '+selectObject.getSize()+'</p>');
							$('div.previewInfoFileDir').append('<p class="contentInfo">Modif. le : '+selectObject.lastMod+'</p>');
						}

					});
				});
				
				jQuery('div.directory').contextMenu({
					menu: 'gsDirMenu'
				},
					function(action, el, pos) {
						jQuery(el).doGSAction({action: action, script: o.script, type: 'dir',lg: o.language});
				},
				manageMenu);

			}
			
			function showTree(c, t) {
			    var cObject = jQuery(c);
				cObject.addClass('wait');
				showLoading();
				jQuery(".jqueryFileTree.start").remove();
				$.ajax({
					type: 'POST',
					url: o.script,
					data: { dir: t },
					dataType: 'script',
					contentType : 'application/x-www-form-urlencoded; charset=utf-8',
					success: function(data) {
						//remember current dir id
						jQuery("#curDir").html(decodeURIComponent(t));
						jQuery("#curDir").attr('rel', jQuery('a', cObject).attr('id'));
						
						cur_items = new Array();

						var dirhtml = '';
						if (typeof(gsdirs) != 'undefined' && gsdirs.length > 0) {
							dirhtml += "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
							for (var num in gsdirs) {
								 var curItem = gsdirs[num];
								 dirhtml += "<li class=\"directoryMeny collapsed\"><span class='dir_index toggleplus'>&nbsp;&nbsp;&nbsp;&nbsp;</span><a href=\"#\" rel=\"" + curItem.path + "/\" id=\"" + curItem.id + "\">" + curItem.name + "</a></li>";
							}
							dirhtml += "</ul>";
						} else {
							gsdirs = new Array();
						}
						if (typeof(gsfiles) == 'undefined') {
							gsfiles = new Array();
						}
						
						cObject.find('.start').html('');
	
						cObject.find('ul').remove();
	
						cObject.removeClass('wait').append(dirhtml);
						
						showContent(gsdirs, gsfiles, unescape(t));
	
						if( o.root == t ) {
							cObject.find('ul:hidden').show(); 
						} else {
							cObject.find('ul:hidden').slideDown({ duration: o.expandSpeed, easing: o.expandEasing });
						}
					    setHandlers(cObject);
				   }});
			}

			function setHandlers(t) {
				//jQuery(t).find('LI').droppable();
				jQuery(t).find('li > a').bind('click', function () {
					showTree (jQuery(this).parent(), encodeURIComponent(jQuery(this).attr('rel').match( /.*\// )));
					jQuery(this).parent().removeClass('collapsed').addClass('expanded');
					jQuery(this).parent().find(' > span').removeClass('toggleplus').addClass('toggleminus');
				});
				jQuery(t).find('li > span').bind('click', function () {
					var thisEl = jQuery(this);
					if( thisEl.parent().hasClass('collapsed') ) {
						thisEl.parent().find('ul').slideDown({ duration: o.collapseSpeed, easing: o.collapseEasing });
						var contenUL = thisEl.parent().find('ul');
						if (contenUL.length < 1) {
							thisEl.parent().find('a').trigger('click');
							thisEl.parent().find(' > span').removeClass('toggleplus').addClass('toggleminus');
						}
						thisEl.parent().removeClass('collapsed').addClass('expanded');
						thisEl.parent().find(' > span').removeClass('toggleplus').addClass('toggleminus');
					} else {
						thisEl.parent().find('ul').slideUp({ duration: o.collapseSpeed, easing: o.collapseEasing });
						thisEl.parent().removeClass('expanded').addClass('collapsed');
						thisEl.parent().find(' > span').removeClass('toggleminus').addClass('toggleplus');
					}
				});
			}
			
			//Affiche la racine de l'arborescence
			function showRoot(){
				showTree( jQuery('#dirList'), escape(o.root));
				//jQuery(this).parent().parent().find('ul').slideUp({ duration: o.collapseSpeed, easing: o.collapseEasing });
				//jQuery(this).parent().parent().find('li.directory').removeClass('expanded').addClass('collapsed');
			}
			
			var cusElement = jQuery('#dirList');
			// Loading message
			cusElement.html('<ul class="jqueryFileTree start"><li class="wait">' + o.loadMessage + '<li></ul>');
			// Get the initial file list
			cusElement.prepend('<a href="#" id="rootLink">Racine</a>');
			cusElement.find('#rootLink').bind('click', showRoot);
			
			showRoot();
		},
		
		doGSAction: function(o) {
			//Fonction du bouton Select all
			if (o.action == '20') {
				jQuery("#dirsFilesTable div.item").each(function(){
					if (jQuery(this).attr('rel') != 'up') {
					    jQuery(this).addClass('rowSelected');
					}
				});
				return false;
			}
			//Lorsqu'on clic dans l'arborescence de fichier, on enlève la selection des fichiers
			if (o.action == '21') {
				jQuery("#dirsFilesTable div.item").each(function(){
					jQuery(this).removeClass('rowSelected');
				});
				return false;			
			}
			//Fonction du bouton Invert Select
			if (o.action == '22') {
				jQuery("#dirsFilesTable div.item").each(function(){
					if (jQuery(this).attr('rel') != 'up') {
						if (jQuery(this).hasClass('rowSelected')) {
						    jQuery(this).removeClass('rowSelected');
						} else {
							jQuery(this).addClass('rowSelected');
						}
					}
				});
				return false;
			}
			var curDir = jQuery("#curDir").html();
			var dataForSend = null;
			var item = get_cur_item(jQuery(this).attr('rel'));

			if (item == null) {
				//alert('no item');
		    }
			
			if (o.action == '23') { // zip
            	unZipItem(o, curDir, item);
				return;
			}
			
			if (o.action == '12') { // show notepad
				showNotePad(o, curDir, item);
				return;
			}
			
			if (o.action == '13') { // copy as
				copyAs(o, curDir, item);
				return;
			}
			
			if (o.action == '14') { // show upload
				jQuery('#dialogUploadFiles').dialog({title: getTranslation(o.lg, 29), modal: true, width: 460, height: 460,
					buttons: [ {text: getTranslation(o.lg, 28), 
						        click: function() { 
						    	            jQuery(this).dialog("close");
						                }
					           },
					           {
						       text: getTranslation(o.lg, 3),
						       click: function() {
								    	   jQuery(this).find("input[name=dir]").val(curDir);
								    	   jQuery('#uploadForm').submit(); 
						               }
					         }]	
				});
				return;
			}

            if (o.action == '19') { // zip
            	zipItem(o, curDir, item);
				return;
			}
			if (o.action == '7') { // copy
				var clipBoard = jQuery("#clipBoard");
				storeSelectedItems();
				clipBoard.html('(Copie) ' + clipboard.length + ' ' + getTranslation(o.lg, 30));
				clipBoard.attr('rel', o.action);
				return;
			}
			if (o.action == '8') { // cut
				var clipBoard = jQuery("#clipBoard");
				storeSelectedItems();
				clipBoard.html('(Couper) ' + clipboard.length + ' ' + getTranslation(o.lg, 30));
				clipBoard.attr('rel', o.action);
				return;
			}
			if (o.action == '9') { //paste
				pasteItems(o, curDir, item);
				return;
			}
			if (o.action == '10') { //rename
				renameItem(o, curDir, item);
				return;
			}
			if (o.action == '11') { //download
				dataForSend = {opt: 8, filename: item.name, dir: curDir};
				location.href= makeUrl(o.script, jQuery.param(dataForSend));
				return;
			}
			if (o.action == '31') { //download Url
				dataForSend = {opt: 8, filename: item.name, dir: curDir};
				var urlDowload = makeUrl(o.script, jQuery.param(dataForSend));
				var newName = window.prompt( 'URL : ', 'http://127.0.0.1/cubbyholeFinal/' + urlDowload);
				return urlDowload;
			}
			if (o.action == '2') { //new file
				newFile(o, curDir, item);
				return;
			}
			if (o.action == '3') { //new dir
				newDir(o, curDir, item);
				return;
			}
			if (o.action == '4' || o.action == '6') { //delete item
				deleteItem(o, curDir, item);
				return;
			}
			if (o.action == '5') { //open dir
				jQuery('#' + item.id).trigger('click');
				return;
			}
			
			function showNotePad(o, curDir, item){
				var height = parseInt(jQuery(window).height()) - 100;
				var width = parseInt(jQuery(window).width()) - 100;
				var rows = parseInt(height / 30);
				var cols = parseInt(width / 10);
				jQuery('#notepadEdit').dialog({title: 'Edit ' + item.name, modal: true, width: width, height: height,
					buttons: [ { 
					             click: function() { jQuery(this).dialog("close"); },
					             text: getTranslation(o.lg, 28)
					            },
					            {
						           text: getTranslation(o.lg, 31), 
							       click: function() {
								    	   jQuery(this).find('textarea').hide();
								    	   jQuery(this).append('<div class="loadingDiv">&nbsp;</div>');
								    	   texta = jQuery('#notepadEdit').find('textarea');
										   targetFile = texta.attr('rel');
										   content = texta.val();
										   dataForSend = {opt: 10, filename: targetFile, dir: curDir, filenContent: content};
										   sendAndRefresh(o, dataForSend, true, function(data) {
									              jQuery('#notepadEdit').find('div.loadingDiv').remove();
									              jQuery('#notepadEdit').find('textarea').show();
										   });
						         }    
					         }]	
				});
				jQuery('#notepadEdit').html('<div class="loadingDiv">&nbsp;</div>');
				dataForSend = {opt: 9, filename: encodeURIComponent(item.name), dir: curDir};
				sendAndRefresh(o, dataForSend, false, function(data) {
					jQuery('#notepadEdit').html('<textarea name=\'gsFileContent\' rows="' + rows + '" cols="' + cols + '" rel="' + item.name +'">' + data + '</textarea>');
	      	    });
			}
			
			function pasteItems(o, curDir, item){
				var clipBoard = jQuery("#clipBoard");
				var opt = null;
				var selectedFiles = getSelectedItemsPath();
				if (clipBoard.attr('rel') == '7') { //copy
					opt = 5;
				} else if (clipBoard.attr('rel') == '8') { // paste
					clipboard = new Array();
					clipBoard.html('0 items');
					jQuery('#clipboardContent').html('');
					clipBoard.attr('rel', '');
					opt = 7;
				} else {
					return;
				}
				if (selectedFiles != null) {
				    dataForSend = {opt: opt, files: selectedFiles, dir: curDir};
				    sendAndRefresh(o, dataForSend, true);
				}
				if (opt == 7) {
					for (var xx in clipboard) {
						 if (clipboard[xx].getExt() == 'dir') {
				             jQuery("#" + clipboard[xx].id).parent().remove();
						 }
					}
				}
			}
			
			function copyAs(o, curDir, item){
				var newName = window.prompt(getTranslation(o.lg, 34) + ': ', htmlspecialchars_decode(item.name, 'ENT_QUOTES'));
				if (newName == null) {
					return;
				} 
				dataForSend = {opt: 14, filename: item.name, dir: curDir, newfilename: newName};
				sendAndRefresh(o, dataForSend, true);
			}
			
			function unZipItem(o, curDir, item){
				var newName = window.prompt(getTranslation(o.lg, 43) + ': ', 'unzipped_' + htmlspecialchars_decode(item.name, 'ENT_QUOTES'));
				if (newName == null) {
					return;
				}
				dataForSend = {opt: 17, filename: item.name, dir: curDir, newfilename: newName};
				sendAndRefresh(o, dataForSend, true);
			}
			
			function zipItem(o, curDir, item){
				var newName = window.prompt(getTranslation(o.lg, 41) + ': ', htmlspecialchars_decode(item.name, 'ENT_QUOTES') + '.zip');
				if (newName == null) {
					return;
				}
				dataForSend = {opt: 16, filename: item.name, dir: curDir, newfilename: newName};
				sendAndRefresh(o, dataForSend, true);
			}
			
			function renameItem(o, curDir, item){
				var newName = window.prompt(getTranslation(o.lg, 35) + ': ', htmlspecialchars_decode(item.name, 'ENT_QUOTES'));
				if (newName == null) {
					return;
				}
				dataForSend = {opt: 6, filename: curDir+item.name, dir: curDir, newfilename: newName};
				sendAndRefresh(o, dataForSend, true);
			}
			
			function newFile(o, curDir, item){
				var newName = window.prompt(getTranslation(o.lg, 36) + ': ');
				if (newName == null || newName.length < 1) {
					return;
				} 
				dataForSend = {opt: 2, filename: newName, dir: curDir};
				sendAndRefresh(o, dataForSend, true);
			}
			
			function newDir(o, curDir, item){
				var newName = window.prompt(getTranslation(o.lg, 37) + ': ');
				if (newName == null || newName.length < 1) {
					return;
				} 
				dataForSend = {opt: 3, filename: newName, dir: curDir};
				sendAndRefresh(o, dataForSend, true);
			}
			
			function deleteItem(o, curDir, item){
				if(!window.confirm(getTranslation(o.lg, 38))){
					return;
				}
				var selectedFiles = getSelectedItems();
				if (selectedFiles != null) {
					dataForSend = {opt: 4, files: encodeURIComponent(selectedFiles), dir: curDir};
				}
				sendAndRefresh(o, dataForSend, true);
			}
			
			function sendAndRefresh(o, dataForSend, refresh, callback, type) {
				if (refresh) {
					showLoading();
				}
				if (typeof(type) == 'undefined') {
					type = 'text';
				}
				//dataForSend.dir = encodeURIComponent(dataForSend.dir);
				$.ajax({
					type: 'POST',
					url: o.script,
					data: jQuery.param(dataForSend) + '&time='+ new Date().getTime(),
					dataType: type,
					contentType : 'application/x-www-form-urlencoded;charset=utf-8',
						beforeSend : function(xhr) {
					   		xhr.setRequestHeader('Accept', "text/html; charset=utf-8");
					},
					success: function(data) {
						checkResponce(data);
						if (refresh) {
							jQuery('#'+jQuery("#curDir").attr('rel')).trigger('click');
						}
						if (callback) {
							callback(data);
						}
				}});
			}
			
			function htmlspecialchars_decode(string, quote_style) {
				  var optTemp = 0,
					i = 0,
					noquotes = false;
				  if (typeof quote_style === 'undefined') {
					quote_style = 2;
				  }
				  string = string.toString().replace(/&lt;/g, '<').replace(/&gt;/g, '>');
				  var OPTS = {
					'ENT_NOQUOTES': 0,
					'ENT_HTML_QUOTE_SINGLE': 1,
					'ENT_HTML_QUOTE_DOUBLE': 2,
					'ENT_COMPAT': 2,
					'ENT_QUOTES': 3,
					'ENT_IGNORE': 4
				  };
				  if (quote_style === 0) {
					noquotes = true;
				  }
				  if (typeof quote_style !== 'number') { // Allow for a single string or an array of string flags
					quote_style = [].concat(quote_style);
					for (i = 0; i < quote_style.length; i++) {
					  // Resolve string input to bitwise e.g. 'PATHINFO_EXTENSION' becomes 4
					  if (OPTS[quote_style[i]] === 0) {
						noquotes = true;
					  } else if (OPTS[quote_style[i]]) {
						optTemp = optTemp | OPTS[quote_style[i]];
					  }
					}
					quote_style = optTemp;
				  }
				  if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
					string = string.replace(/&#0*39;/g, "'"); // PHP doesn't currently escape if more than one 0, but it should
					// string = string.replace(/&apos;|&#x0*27;/g, "'"); // This would also be useful here, but not a part of PHP
				  }
				  if (!noquotes) {
					string = string.replace(/&quot;/g, '"');
				  }
				  // Put this in last place to avoid escape being double-decoded
				  string = string.replace(/&amp;/g, '&');

				  return string;
			}
		}
	});
	
})(jQuery);