( function( $, elementor ) {
	'use strict';

	var ElementsKitParallax = {

		init: function() {
			elementor.hooks.addAction( 'frontend/element_ready/section', ElementsKitParallax.elementorSection );
		},

        elementorSection: function( $scope ) {
			var $target   = $scope,
				instance  = null,
				editMode  = Boolean( elementor.isEditMode() );

			instance = new ElementsKitSectionParallaxPlugin( $target );
            instance.init(instance);
		},
	};

	$( window ).on( 'elementor/frontend/init', ElementsKitParallax.init );

    window.ElementsKitSectionParallaxPlugin = function( $target ) {
            var self             = this,
                sectionId        = $target.data('id'),
                settings         = false,
                editMode         = Boolean( elementor.isEditMode() ),
                $window          = $( window ),
                $body            = $( 'body' ),
                scrollLayoutList = [],
                mouseLayoutList  = [],
                winScrollTop     = $window.scrollTop(),
                winHeight        = $window.height(),
                requesScroll     = null,
                requestMouse     = null,
                x = {},
                isSafari         = !!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/),
                platform         = navigator.platform;

            /**
             * Init
             */
            self.init = function() {
                self.setParallaxMulti( sectionId );
                self.moveBg( sectionId );

                return false;
            };

            self.setParallaxMulti = function( sectionId ) {
                var optionsRaw        = {},
                    optionsOpt        = null,
                    options           = [];

                optionsRaw = self.getOptions( sectionId, 'ekit_section_parallax_multi_items' );
                optionsOpt = self.getOptions( sectionId, 'ekit_section_parallax_multi' );

                if(optionsOpt != 'yes'){
                    return;
                }

                if(editMode){
                    if (! optionsRaw.hasOwnProperty( 'models' ) || 0 === Object.keys( optionsRaw.models ).length || optionsOpt != 'yes') {
                        return;
                    }
                    optionsRaw = optionsRaw.models;
                }


                $target.addClass('elementskit-parallax-multi-container');

                $.each( optionsRaw, function( index, obj ) {
                    if(obj.hasOwnProperty('attributes')){
                        obj = obj.attributes;
                    }
                    options.push( obj );
                    self.pushElement(obj);
                    self.getSVG();
                });

                if ( options.length < 0 ) {
                    return options;
                }


                $target.on('mousemove', function (e) {
                    $.each(options, function (index, obj){
                        if(obj.parallax_style == 'mousemove'){
                            self.moveItem(obj, e);
                        }
                    });
                });

                $.each(options, function (index, obj){
                    if(obj.parallax_style == 'tilt'){
                        self.tiltItem(obj);
                    }
                    if(obj.parallax_style == 'onscroll'){
                        self.walkItem(obj);
                    }
                });
            };

            self.moveBg = function (sectionId){
                // return;
                var optionsOpt        = null,
                optionsSpeed          = .2;


                optionsOpt = self.getOptions( sectionId, 'ekit_section_parallax_bg' );
                optionsSpeed = self.getOptions( sectionId, 'ekit_section_parallax_bg_speed' );

                $target.addClass('elementskit-parallax-multi-container');
// console.log(editMode);

                if(optionsOpt == 'yes' && !editMode){
                    $target.jarallax({
                        speed: optionsSpeed
                    });
                }


            };

            self.walkItem = function(obj){
                if(obj.parallax_transform !== undefined && obj.parallax_transform_value !== undefined){
                    // console.log(obj);
                    $target.find('.elementor-repeater-item-' +obj._id).magician({
                        type: 'scroll',
                        offsetTop: parseInt(obj.offsettop),
                        offsetBottom: parseInt(obj.offsetbottom),
                        duration: parseInt(obj.smoothness),
                        animation:{
                            [obj.parallax_transform]: obj.parallax_transform_value
                        }
                    });
                }
            };

            self.moveItem = function(obj, e){
                var relX = e.pageX - $target.offset().left;
                var relY = e.pageY - $target.offset().top;

                TweenMax.to($target.find('.elementor-repeater-item-' +obj._id), 1, {
                    x: (relX - $target.width() / 2) / $target.width() * obj.parallax_speed,
                    y: (relY - $target.height() / 2) / $target.height() * obj.parallax_speed,
                    ease: Power2.ease
                });
            };

            self.tiltItem = function(obj){
                var container = $target.find('.elementor-repeater-item-' +obj._id),
                    item = container.find('img');
                    container.tilt({
                        disableAxis: obj.disableaxis,
                        scale: obj.scale,
                        speed: obj.parallax_speed,
                        maxTilt: obj.maxtilt,
                        glare: true,
                        maxGlare: .5
                    });
            };

            self.getOptions = function(sectionId, key){
                var editorElements      = null,
                sectionData             = {};


                if ( ! editMode ) {
                    sectionId = 'section' + sectionId;

                    if(!window.elementskit_section_parallax_data || ! window.elementskit_section_parallax_data.hasOwnProperty( sectionId )){
                        return false;
                    }

                    if(! window.elementskit_section_parallax_data[ sectionId ].hasOwnProperty( key )){
                        return false;
                    }

                    return window.elementskit_section_parallax_data[ sectionId ][key];
                }else{
                    if ( ! window.elementor.hasOwnProperty( 'elements' ) ) {
                        return false;
                    }
                    editorElements = window.elementor.elements;
                    if ( ! editorElements.models ) {
                        return false;
                    }
                    $.each( editorElements.models, function( index, obj ) {
                        if ( sectionId == obj.id ) {
                            sectionData = obj.attributes.settings.attributes;
                        }
                    });

                    if ( ! sectionData.hasOwnProperty( key ) ) {
                        return false;
                    }
                }





                return sectionData[ key ];
            };

            self.pushElement = function(elData){

                var klass = 'ekit-section-parallax-mousemove ekit-section-parallax-layer elementor-repeater-item-'+elData._id;
                var shapeKlass = '';
                if(elData.item_source == 'shape'){
                    elData.image.url = window.elementskit_module_parallax_url + 'assets/svg/' + elData.shape+'.svg';
                    klass = klass + ' ekit-section-parallax-layer-shape';
                    shapeKlass = 'shape-' + elData.shape.replace('.svg', '');
                }


                if($target.find('.elementor-repeater-item-'+elData._id).length === 0 && elData.image.url != ''){
                    $target.prepend(`
                        <div class="${klass}" >
                            <img class="elementskit-parallax-graphic ${shapeKlass}" src="${elData.image.url}"/>
                        </div>
                    `);
                }
            };

            self.getSVG = function(){
                $target.find('.ekit-section-parallax-layer-shape img').each(function(){
                    var img = $(this);
                    var attributes = img.prop("attributes");
                    var imgURL = img.attr("src");
                    $.get(imgURL, function (data) {
                      var svg = $(data).find('svg');
                      svg = svg.removeAttr('xmlns:a');
                      $.each(attributes, function() {
                        svg.attr(this.name, this.value);
                      });
                      img.replaceWith(svg);
                    });
                });
            }
        }

}( jQuery, window.elementorFrontend ) );
