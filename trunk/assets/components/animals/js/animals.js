/*	Base Page
*/
MODx.panel.Home = function(config) {
	config = config || {};
	Ext.apply(config,{
		id: 'modx-panel-home'
		,border: false
		,defaults: { autoHeight: true}
		,items: [{
			xtype: 'modx-panel-animals'
//		},{
//			xtype: 'modx-panel-categories'
		}]
	});
MODx.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(MODx.panel.Home,MODx.Tabs);
Ext.reg('modx-panel-home',MODx.panel.Home);
 
/*	Initiate on Page load
*/
Ext.onReady(function(){
	MODx.add("modx-panel-home");
});

/*	Blog Panel
*/
MODx.panel.animals=function(A){
	A=A||{};
	Ext.applyIf(A,{
		id:"modx-panel-animals",
        title: _('animals.animals'),
		bodyStyle:"padding: 0 10px 10px 10px;",
		defaults:{
			collapsible:false,
			autoHeight:true
		},
		items:[
			{
				html:"<h2>"+_("animals.animals")+"</h2>",
				border:false,
				id:"modx-animals-header",
				cls:"modx-page-header"
			},{
				layout:"form",
				bodyStyle:"padding: 15px",
				autoHeight:true,
				defaults:{border:false},
				items:[
					{html:"<p>"+_("animals.admin.desc")+"</p>"},
					{xtype:"modx-grid-animals",preventSaveRefresh:true}
				]
			}
		]
	});
	MODx.panel.animals.superclass.constructor.call(this,A);
};
Ext.extend(MODx.panel.animals,MODx.FormPanel);
Ext.reg("modx-panel-animals",MODx.panel.animals);

/*
*/
MODx.grid.animalsGrid = function (A) {
	A = A || {};
	if (!A.tbar) {
		A.tbar = [{
			text: _("animals.create"),
			scope: this,
			handler: {
				xtype: "modx-window-animal-updateA",
//				xtype: "modx-formpanel-animal-update-wrap",
				url: A.url || MODx.config.connectors_url + "animals/animals.php",
				blankValues: true
			}
		}];
	}
	this.cm = new Ext.grid.ColumnModel({
		columns: [{
			header: '#',
			dataIndex: "id",
			sortable: true,
			editable: false,
			width: 5
		}, {
			header: _('animals.name')
			,dataIndex: "name"
			,sortable: true
			,editable: false
			,width: 15
		}, {
			header: _("animals.description")
			,dataIndex: "description"
			,sortable: true
			,editable: true
			,width: 40
		}, {
			header: _('animals.gender')
			,dataIndex: "gender"
			,sortable: true
			,editable: false
			,hidden: true
			,width: 10
		}, {
			header: _('animals.gender')
			,dataIndex: "gender"
			,sortable: true
			,editable: false
			,hidden: true
			,width: 10
		}, {
			header: _('animals.species')
			,dataIndex: "species"
			,sortable: true
			,editable: false
			,hidden: true
			,width: 20
		}]
	});
	Ext.applyIf(A, {
		cm: this.cm,
		fields: ["id", "name", "pageId", "description", "gender", 'species_id', 'species', 'height', 'weight'],
		baseParams: {
			action: "getAnimals",
			namespace: MODx.request.namespace ? MODx.request.namespace : "core"
		},
		clicksToEdit: 2,
		grouping: true,
		groupBy: "species_id",
		singleText: _("animals_animal"),
		pluralText: _("animals_animals"),
		sortBy: "species_id",
		primaryKey: "id",
		autosave: true,
		pageSize: MODx.config.default_per_page > 30 ? MODx.config.default_per_page : 30,
		paging: true,
		collapseFirst: false
	});
	MODx.grid.animalsGrid.superclass.constructor.call(this, A);
};

/*	Adding Event Listeners and Menu's etc.
*/
Ext.extend(MODx.grid.animalsGrid, MODx.grid.Grid, {
	listeners: {
	},
	_showMenu: function (C, B, D) {
		D.stopEvent();
		D.preventDefault();
		this.menu.record = this.getStore().getAt(B).data;
		if (!this.getSelectionModel().isSelected(B)) {
			this.getSelectionModel().selectRow(B);
		}
		this.menu.removeAll();
		var A = [];
		if (this.menu.record.menu) {
			A = this.menu.record.menu;
		} else {
			A.push({
				text: _("animals.update_main_details"),
				handler: this.updateAnimal
			});
			A.push({
				text: _("animals.update_detended_details"),
				handler: this.updateAnimal
			});
			A.push({
				text:_('animals.remove'),
				handler: this.remove.createDelegate(this, ["animals.remove.confirm"])
			});
		}
		if (A.length > 0) {
			this.addContextMenuItem(A);
			this.menu.showAt(D.xy);
		}
	}
	,updateAnimal: function (A, C) {
		var B = this.menu.record;
		B.fk = Ext.isDefined(this.config.fk) ? this.config.fk : 0;
		var D = MODx.load({
			xtype: "modx-window-animal-updateA",
//			xtype: "modx-formpanel-animal-update-wrap",
			record: B,
			grid: this,
			listeners: {
				success: {
					fn: function (E) {
						this.refresh();
					},
					scope: this
				}
			}
		});
		D.reset();
//console.log(B);
		D.setValues(B);
		D.show(C.target);
	}
});
/*	URL to get data from when loading and refreshing
*/
MODx.grid.animals=function(A){
	A=A||{};
console.log('Need to alter before packing');
	Ext.applyIf(A,{url:MODx.config.connectors_url+"animals/animals.php"});
//	Ext.applyIf(A,{url:"/3rdParty/animals/trunk/connectors/animals/animals.php"});
	MODx.grid.animals.superclass.constructor.call(this,A);
};
Ext.extend(MODx.grid.animals,MODx.grid.animalsGrid);
Ext.reg("modx-grid-animals",MODx.grid.animals);





/*
MODx.FormPanel.animalUpdateWrap = function(A) {
	A = A || {};
	Ext.applyIf(A, {
	});
	MODx.FormPanel.animalUpdateWrap.superclass.constructor.call(this, A);
};
Ext.extend(MODx.FormPanel.animalUpdateWrap, MODx.FormPanel);
Ext.reg("modx-formpanel-animal-update-wrap", MODx.FormPanel.animalUpdateWrap);
*/


/*
MODx.panel.animalUpdateA = function(config) {
console.log('animalUpdateA');
	config = config || {};
	Ext.apply(config,{
		id: 'modx-panel-animal-update-A'
		,title: 'Details'

//		,autoDestroy: false
//		,deferredRender: false
//		,activeTab: 0
//		,autoTabs: true

		,border: false
		,html: '<p>UPdate Panel A</p>'
//		,defaults: { autoHeight: true}
		,fields: [{
			xtype: "hidden",
			name: "id",
			id: "modx-cs-fk",
			value: config.id || 0
		}, {
			xtype: "textfield",
			fieldLabel: _("animals.name"),
			name: 'pageId',
			allowBlank: true,
			anchor: "90%"
		}, {
			xtype: "htmleditor",
			fieldLabel: _("animals.description"),
			name: "description",
			anchor: "90%"
		}]
	});
	MODx.panel.animalUpdateA.superclass.constructor.call(this,config);
};
Ext.extend(MODx.panel.animalUpdateA, MODx.FormPanel);
Ext.reg('modx-panel-animal-update-A',MODx.panel.animalUpdateA);

MODx.panel.animalUpdateB = function(config) {
console.log('animalUpdateB');
	config = config || {};
	Ext.apply(config,{
		id: 'modx-panel-animal-update-B'
		,title: 'Details'

//		,autoDestroy: false
//		,deferredRender: false
//		,activeTab: 0
//		,autoTabs: true

		,border: false
		,html: '<p>UPdate Panel B</p>'
//		,defaults: { autoHeight: true}
		,fields: [{
			xtype: "hidden",
			name: "id",
			id: "modx-cs-fk",
			value: config.id || 0
		}, {
			xtype: "textfield",
			fieldLabel: _("animals.name"),
			name: 'pageId',
			allowBlank: true,
			anchor: "90%"
		}, {
			xtype: "htmleditor",
			fieldLabel: _("animals.description"),
			name: "description",
			anchor: "90%"
		}]
	});
	MODx.panel.animalUpdateB.superclass.constructor.call(this,config);
};
Ext.extend(MODx.panel.animalUpdateB, MODx.FormPanel);
Ext.reg('modx-panel-animal-update-B',MODx.panel.animalUpdateB);


MODx.FormPanel.animalUpdate = function(config) {
	config = config || {};
	Ext.apply(config,{
		id: 'modx-panel-animal-update'
		,border: false
		,defaults: { autoHeight: true}

		,autoDestroy: false
		,deferredRender: false
		,activeTab: README file0
		,autoTabs: true

		,items: [{
			xtype: 'modx-panel-animal-update-A'
		},{
			xtype: 'modx-panel-animal-update-B'
		}]
	});
	MODx.FormPanel.animalUpdate.superclass.constructor.call(this,config);
};
Ext.extend(MODx.FormPanel.animalUpdate,MODx.Tabs, MODx.FormPanel);
Ext.reg('modx-panel-animal-update',MODx.FormPanel.animalUpdate);

MODx.window.animalUpdate = function (A) {
	A = A || {};
	var B = A.ident || "modx-uss-" + Ext.id();
	Ext.applyIf(A, {
		title: _("animals.update")
		,width: 800
		,url: A.grid.config.url
		,action: "updateAnimal"

		,items: [{
			xtype: 'modx-panel-animal-update'
		}]
	});
	MODx.window.animalUpdate.superclass.constructor.call(this, A);
};
Ext.extend(MODx.window.animalUpdate, MODx.Window);
Ext.reg("modx-window-animal-update", MODx.window.animalUpdate);
*/




/*	Window for updating Animal	*/
/*	Unable to find how to tabulate the data so needing to be done in 2 windows	*/
MODx.window.animalUpdateA = function (A) {
	A = A || {};
	var B = A.ident || "modx-uss-" + Ext.id();
	Ext.applyIf(A, {
		title: _("animals.update"),
		width: 800,
		url: A.grid.config.url,
		action: "updateAnimal",

/*		shadow: false,
		resizable: true,
		collapsible: true,
		maximizable: true,
		allowDrop: true,
		height: 600,
		forceLayout: true,
		boxMaxHeight: 700,
		maxHeight: 700,
		autoScroll: true,*/

		fields: [{
			xtype: "hidden",
			name: "id",
			id: "modx-cs-fk",
			value: A.id || 0
		}, {
			xtype: "textfield",
			fieldLabel: _("animals.name"),
			name: 'pageId',
			allowBlank: true,
			anchor: "90%"
		}, {
			xtype: "htmleditor",
			fieldLabel: _("animals.description"),
			name: "description",
			anchor: "90%"
		}, {
			xtype: "textfield",
			fieldLabel: _("animals.height"),
			name: "height",
//			anchor: "90%"
		}, {
			xtype: "textfield",
			fieldLabel: _("animals.weight"),
			name: "weight",
//			anchor: "90%"
		}, {
			fieldLabel: _("animals.good_with_cats")
			,hiddenName:"good_with_cats"
			,name: "good_with_cats"
			,xtype: 'modx-combo-goodwith'
		}, {
			fieldLabel: _("animals.good_with_dogs")
			,hiddenName:"good_with_dogs"
			,name: "good_with_dogs"
			,xtype: 'modx-combo-goodwith'
		}, {
			fieldLabel: _("animals.good_with_children")
			,hiddenName:"good_with_children"
			,name: "good_with_children"
			,xtype: 'modx-combo-goodwith'
		}, {
			fieldLabel: _("animals.good_with_travel")
			,hiddenName:"good_with_travel"
			,name: "good_with_travel"
			,xtype: 'modx-combo-goodwith'
		}, {
			xtype: 'modx-combo-gender'
		}, {
			xtype: 'modx-combo-species'
		}]
	});
	MODx.window.animalUpdateA.superclass.constructor.call(this, A);
};
Ext.extend(MODx.window.animalUpdateA, MODx.Window);
Ext.reg("modx-window-animal-updateA", MODx.window.animalUpdateA);


MODx.window.animalUpdateB = function (A) {
	A = A || {};
	var B = A.ident || "modx-uss-" + Ext.id();
	Ext.applyIf(A, {
		title: _("animals.update"),
		width: 800,
		url: A.grid.config.url,
		action: "updateAnimalB",

/*		shadow: false,
		resizable: true,
		collapsible: true,
		maximizable: true,
		allowDrop: true,
		height: 600,
		forceLayout: true,
		boxMaxHeight: 700,
		maxHeight: 700,
		autoScroll: true,*/

		fields: [{
			xtype: "hidden",
			name: "id",
			id: "modx-cs-fk",
			value: A.id || 0
		}, {
			xtype: "textfield",
			fieldLabel: _("animals.name"),
			name: 'pageId',
			allowBlank: true,
			anchor: "90%"
		}, {
			xtype: "htmleditor",
			fieldLabel: _("animals.description"),
			name: "description",
			anchor: "90%"
		}, {
			xtype: "textfield",
			fieldLabel: _("animals.height"),
			name: "height",
//			anchor: "90%"
		}, {
			xtype: "textfield",
			fieldLabel: _("animals.weight"),
			name: "weight",
//			anchor: "90%"
/*		}, {
			fieldLabel: _("animals.good_with_cats")
			,hiddenName:"good_with_cats"
			,name: "good_with_cats"
			,xtype: 'modx-combo-goodwith'
		}, {
			fieldLabel: _("animals.good_with_dogs")
			,hiddenName:"good_with_dogs"
			,name: "good_with_dogs"
			,xtype: 'modx-combo-goodwith'
		}, {
			fieldLabel: _("animals.good_with_children")
			,hiddenName:"good_with_children"
			,name: "good_with_children"
			,xtype: 'modx-combo-goodwith'
		}, {
			fieldLabel: _("animals.good_with_travel")
			,hiddenName:"good_with_travel"
			,name: "good_with_travel"
			,xtype: 'modx-combo-goodwith'
		}, {
			xtype: 'modx-combo-gender'
		}, {
			xtype: 'modx-combo-species'
*/		}]
	});
	MODx.window.animalUpdateB.superclass.constructor.call(this, A);
};
Ext.extend(MODx.window.animalUpdateB, MODx.Window);
Ext.reg("modx-window-animal-updateB", MODx.window.animalUpdateB);



/*	Gender Dropdown List
*/MODx.combo.Gender=function(A){
	A=A||{};
	Ext.applyIf(
		A,
		{
			name:"gender"
			,hiddenName:"gender"
			,fieldLabel: _("animals.gender")
			,displayField:'description'
			,valueField:"id"
			,mode: 'local'
//			,mode:"remote"
			,fields:["id","description"]
			,forceSelection:true
			,typeAhead:false
			,allowBlank:false
			,editable:false
			,enableKeyEvents:true
//			,url:MODx.config.connectors_url+"element/category.php"
//			,url: A.url || MODx.config.connectors_url + "animals/animals.php"
//			,baseParams:{action:"getAftercares",showNone:true}
			,store: new Ext.data.ArrayStore({
				id: 0
				,fields:["id","description"]
				,data: [
					['M',_("animals.male")]
					,['F',_("animals.female")]
					,['?',_("animals.unknown")]
				]
			})
		}
	);
	MODx.combo.Gender.superclass.constructor.call(this,A);
};
Ext.extend(MODx.combo.Gender,
	MODx.combo.ComboBox,
	{_onblur:function(B,C){
		var A=this.getRawValue();
		this.setRawValue(A);
		this.setValue(A,true);
	}
});
Ext.reg("modx-combo-gender",MODx.combo.Gender);

/*	Species Dropdown List
*/MODx.combo.Species=function(A){
	A=A||{};
	Ext.applyIf(
		A,
		{name:"species"
			,hiddenName:"species"
			,fieldLabel: _("animals.species")
			,displayField:'description'
			,valueField:"id"
			,mode:"remote"
			,fields:["id","description"]
			,forceSelection:true
			,typeAhead:false
			,allowBlank:false
			,editable:false
			,enableKeyEvents:true
			,url:MODx.config.connectors_url+"element/species.php"
			,url: A.url || MODx.config.connectors_url + "animals/animals.php"
			,baseParams:{action:"getSpecies",showNone:true}
		}
	);
	MODx.combo.Species.superclass.constructor.call(this,A);
};
Ext.extend(MODx.combo.Species,
	MODx.combo.ComboBox,
	{_onblur:function(B,C){
		var A=this.getRawValue();
		this.setRawValue(A);
		this.setValue(A,true);
	}
});
Ext.reg("modx-combo-species",MODx.combo.Species);



/*	Goodwith Dropdown List
*/MODx.combo.Goodwith=function(A){
	A=A||{};
	Ext.applyIf(
		A,
		{
			displayField:'description'
			,valueField:"id"
			,fields:["id","description"]
			,forceSelection:true
			,typeAhead:false
			,allowBlank:false
			,mode:"local"
			,editable:false
			,enableKeyEvents:true
//			,url:MODx.config.connectors_url+"element/category.php"
//			,url: A.url || MODx.config.connectors_url + "animals/animals.php"
//			,baseParams:{action:"getAftercares",showNone:true}
			,data: [
				[1,'Good']
				,[0,'Unknown']
				,[-1,'Bad']
			]
		}
	);
	MODx.combo.Goodwith.superclass.constructor.call(this,A);
};
Ext.extend(MODx.combo.Goodwith,
	MODx.combo.ComboBox,
	{_onblur:function(B,C){
		var A=this.getRawValue();
		this.setRawValue(A);
		this.setValue(A,true);
	}
});
Ext.reg("modx-combo-goodwith",MODx.combo.Goodwith);
