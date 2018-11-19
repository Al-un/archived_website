// -- Preload
	var categorie = 0;
	var sommaire	= new Array();
	var image		= new Array();
	var allitem		= new Array();
	
	var i;
	var i;
	
	for (i in menu){
	 	sommaire[i]	= new Array();
	 	image[i]	= new Array();
	 	allitem[i]	= "";
		for (j in menu[i]){
			sommaire[i][j] = new Item(j,menu[i][j]);
			allitem[i] = allitem[i].concat(sommaire[i][j].html());
			image[i][j] = new Image();	
			image[i][j].src = logo[i][j];
		}	
	}
	
	var stillmove;	
	var speedrate = 20;	
	var majorElement;
	

// -- List Element Class
	var margeHautMax = 200;
	var margeHautMiddle = 100;
	var margeGaucheMax = 80;
	var hauteurMin = 10;
	var margeGaucheMin = 200;
	var margeHautMin = 10;
	

	function Item(id,content){
	 
	 	// Attributes
	 	this.id		= id;
	 	this.content 	= content;
		this.margeGauche= margeGaucheMin;
		this.hauteur	= 0;
		this.margeHaut	= 0;
		this.position	= -1;
		this.tailleText	= 0; 
		this.opacity	= 0;
		
		// Method to return the right HTML code
		this.html = function(){
			return ("<DIV id = 'menu_"+this.id+"'><p>" + this.content + "</p></DIV>");
		}
		
		
		// Methods Up & Down
		this.monter = function(){
			
			// -- move only if the height is enough
			if (this.hauteur > 1){
			 	this.position -= 0.01;
				this.updatePosition();
			}
			
			// -- test if the next one has to be launched
			if ( Math.abs(this.position-0.80) < 0.01 ){	
			 	var indice = nex(this.id);
				sommaire[categorie][indice].setPosition(1);
				this.setVisibility("visible");
			}
			
			// -- test is the top id reached
			if ( (this.position)<0 ){
			 	this.setPosition(-1);
			}
		}
		this.descendre = function(){
		 
		 	if ( this.hauteur > 2 ){
				this.position += 0.01;
				this.updatePosition();
			}
			
			// -- test if the next one has to be launched
			if (  Math.abs(this.position-0.20) < 0.01 ){
			 	var indice = pre(this.id);
				sommaire[categorie][indice].setPosition(0);
				this.setVisibility("visible");
			}
			
			// -- test is the bottom id reached
			if ( this.position > 1 ){
			 	this.setPosition(-1);
			}
		}
		
		// update position: function of this.position
		this.updatePosition = function(){
		 
		 	if ( this.position >= 0 && this.position < 0.5 ){
		 	 //	this.hauteur	= Math.round(hauteurMin + 30*(Math.sqrt(this.position)));
		 	 //	this.margeHaut 	= Math.round(margeHautMin+this.position*margeHautMax);
		 	 	this.hauteur	= Math.round(hauteurMin + 40*(this.position));
		 	 	this.margeHaut 	= Math.round(margeHautMin+this.position*margeHautMax);
		 	 	this.tailleText	= Math.round(this.hauteur/2);			
				this.margeGauche= Math.sqrt( Math.pow(margeGaucheMax,2)-Math.pow(margeHautMiddle-this.position*margeHautMax,2) );
				this.margeGauche= margeGaucheMin + Math.round(this.margeGauche);
				this.opacity 	= 2*this.position;
			}
			else if ( this.position >=0.5 && this.position <= 1 ){
			 //	this.hauteur	= Math.round(hauteurMin + 30*(Math.sqrt(1-this.position)));
			 //	this.margeHaut 	= Math.round(margeHautMin+this.position*margeHautMax);
			 	this.hauteur	= Math.round(hauteurMin + 40*(1-this.position));
			 	this.margeHaut 	= Math.round(margeHautMin+this.position*margeHautMax);
			 	this.tailleText	= Math.round(this.hauteur/2);
				this.margeGauche= Math.sqrt( Math.pow(margeGaucheMax,2)-Math.pow(this.position*margeHautMax-margeHautMiddle,2) );
				this.margeGauche= margeGaucheMin + Math.round(this.margeGauche);
				this.opacity	= 2*(1-this.position);
			}
			else{
				this.resetPosition();
			}
			
			var menu_i = document.getElementById('menu_'+this.id);
			menu_i.style.height	= this.hauteur + "px";
			menu_i.style.left		= this.margeGauche + "px";
			menu_i.style.top		= this.margeHaut + "px";
			menu_i.style.fontSize = this.tailleText + "px";
			menu_i.style.opacity	= this.opacity;
			
			try{
				// -- update the illustration
				if ( Math.abs(this.position-0.5) < 0.05 ){
					document.illustration.src = logo[categorie][this.id];
					var html = document.getElementById('html');
					html.src = page[categorie][this.id];
					// resize the iframe
					// html.style.height = html.contentWindow.document.body.scrollHeight + 'px';
				}
			}
			catch(err){
				document.getElementById('debug').innerHTML = err;
			}
		}
		// -- reset position
		this.resetPosition = function(){
			this.hauteur = 0;
			this.margeHaut = 0;
			this.margeGauche = margeGaucheMin;
			this.tailleText = 0;
			this.setVisibility("hidden");
		}
		
		// setters
		this.setPosition = function(position){
			this.position = position;
			this.updatePosition();
		}
		
		this.setVisibility = function(visible){
			document.getElementById('menu_'+this.id).style.visibility = visible;
		}
		
	} // end class Item
	
	
	// ---------------------------------------- function init(cate) --------------------------- //
	
	function init(cate){
	 	categorie = cate;
	 	var majeur = Math.round(10*(Math.random()));
	 	majorElement = majeur;
	 	
	 	document.getElementById('titre').innerHTML = titre[categorie];
	 	document.getElementById('sommaire').innerHTML = allitem[categorie];
	 	document.illustration.src = logo[categorie][majeur];

		for (i in sommaire[categorie]){
			sommaire[categorie][i].resetPosition();
		}

		// -- in the summary		
			sommaire[categorie][pre(pre(majeur))].setPosition(0.05);	
			sommaire[categorie][pre(majeur)].setPosition(0.25);	
			sommaire[categorie][majeur].setPosition(0.45);	
			sommaire[categorie][nex(majeur)].setPosition(0.65);	
			sommaire[categorie][nex(nex(majeur))].setPosition(0.85);
			
			sommaire[categorie][pre(pre(majeur))].setVisibility("visible");	
			sommaire[categorie][pre(majeur)].setVisibility("visible");	
			sommaire[categorie][majeur].setVisibility("visible");		
			sommaire[categorie][nex(majeur)].setVisibility("visible");	
			sommaire[categorie][nex(nex(majeur))].setVisibility("visible");				
			
	document.getElementById('sommaire').style.height = (margeHautMax+10) + "px";	
	
	
		alert('init sommaire end');
	}

	
	


	function pre(i){
		if ( i == 0){	i = (menu[categorie].length-1);	}
		else{			i--;			}
		return i;
	}
	function nex(i){
		if (i == (menu[categorie].length-1)){	i = 0;	}
		else{					i++;	}
		return i
	}


	function move(upORdown){
		var j;
		for (j in menu[categorie]){
			switch(upORdown){
				case "up": 
					sommaire[categorie][j].monter();					
					break;
				case "down":
					sommaire[categorie][j].descendre();
					break;
			}
		}		
		stillmove = setTimeout(move,speedrate,upORdown);	
	}
	
	function stopmove(){
		clearInterval(stillmove);
	}
