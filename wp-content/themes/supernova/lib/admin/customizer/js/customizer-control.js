/**
 *  Contains custom scripts
 */

(function( $, window , undefined ){

    "use strict";

    window.SupModels = {
                      Models  : {},
                      Views   : {}
                    };

    /*==============================
           Ajax Page Loader
    ===============================*/

    SupModels.Models.AjaxPageLoader = Backbone.Model.extend({

        defaults: {
            php_function    : '',
            post_id : ''
        },

    });


    SupModels.Views.AjaxPageLoader = Backbone.View.extend({

        el : 'body',

        events: {
            'change .repeater-field-select select' : 'loadPostsData',
            'click #accordion-section-slider_options_section' : 'updateSlider',
            'click button.sup-upload' : 'uploadImage',
            'click button.sup-remove' : 'removeImage',
            'click .customize-control-code' : 'addFocus'
        },

        initialize: function(){

        },

        loadPostsData : function(e)
        {
            var $this = $(e.currentTarget);
            var post_id = $this.val();
            var $box = $this.closest('li.repeater-row');

            $.ajax({
                url      : ajaxurl,
                type     : 'POST',
                dataType : 'json',
                data     : {
                    action    : 'sup_pull_posts_data',
                    'post_id' : post_id
                },
            })
            .done(function(resp) {
                $box.find('input[data-field="title"]').val(resp.title);
                $box.find('textarea[data-field="excerpt"]').val(resp.excerpt);
                $box.find('input[data-field="attachment_id"]').val( resp.attachment_id );

                if( resp.thumbnail_src !== undefined ){
                    $box.find('.sup-thum-preview').html('<img src="' + resp.thumbnail_src + '">');
                }
                else{
                    $box.find('.sup-thum-preview').html('');
                }

                if( resp.thumbnail_src !== undefined ){
                    $box.find('input[data-field="thumbnail_src"]').val( resp.thumbnail_src );
                }
                else{
                    $box.find('input[data-field="thumbnail_src"]').val( '' );
                }

                if( resp.thumbnail_src ){
                    $box.find('.sup-upload').text("Change Image");
                    $box.find('.sup-change').show();
                }
                else{
                    $box.find('.sup-upload').text("Select Image");
                    $box.find('.sup-change').hide();
                }

                $box.find('input, textarea').keyup();
                $box.find('input, textarea').trigger('change');
            });

        },

        updateSlider : function(e)
        {
            var $this = $(e.currentTarget);
            var $hiddenUrlField = $this.find('.repeater-field-thumbnail_src').height(0);

            $this.find('.repeater-row').each(function(){
                var thumbnail_src = $(this).find('input[data-field="thumbnail_src"]').val();
                if( thumbnail_src ){
                    $(this).find('.sup-thum-preview').html( '<img src="' + thumbnail_src + '">' );
                    $(this).find('.sup-upload').text("Change Image");
                }
                else{
                    $(this).find('.sup-remove').hide();
                }
            });
        },

        uploadImage : function(e)
        {
            e.preventDefault();
            var $this = $(e.currentTarget);
            var $box = $this.closest('li.repeater-row');
            var thumbnail, uploaded_image, imageData, image;

            image = wp.media({
                title: 'Upload Slide Image',
                // mutiple: true if you want to upload multiple files at once
                multiple: false
            })
            .open()
            .on('select', function(e){
                // This will return the selected image from the Media Uploader, the result is an object
                uploaded_image = image.state().get('selection').first();
                // We convert uploaded_image to a JSON object to make accessing it easier
                // Output to the console uploaded_image
                imageData = uploaded_image.toJSON();

                if( $.inArray( imageData.subtype , [ 'jpg','png','PNG','JPG','JPEG', 'jpeg', 'gif' ,'GIF' ] ) < 0 ){
                    alert("Sorry, You can only upload images in slide.");
                    return;
                }

                thumbnail = imageData.subtype === 'gif' ? imageData.url : imageData.sizes.medium.url;

                $box.find('input[data-field="attachment_id"]').val( imageData.id );
                $box.find('.sup-thum-preview').html('<img src="' + thumbnail + '">');
                $box.find('input[data-field="thumbnail_src"]').val( thumbnail );
                $box.find('.sup-upload').text("Change Image");
                $box.find('.sup-remove').show();
                $box.find('input, textarea').trigger('change');
            });
        },

        removeImage : function(e)
        {
            e.preventDefault();
            var $this = $(e.currentTarget);
            var $box = $this.closest('li.repeater-row');

            $box.find('input[data-field="attachment_id"]').val( '' );
            $box.find('.sup-thum-preview').html('');
            $box.find('input[data-field="thumbnail_src"]').val( '' );
            $box.find('.sup-upload').text("Select Image");
            $box.find('input , textarea').trigger('change');
            $this.hide();
        },

        addFocus : function(e){
            var $this = $(e.currentTarget);
            $this.find('textarea').trigger('focus').trigger('keyup').trigger('keypress');
        },


    });


    SupModels.AjaxPageLoader = new SupModels.Views.AjaxPageLoader( { model : new SupModels.Models.AjaxPageLoader() } );

})( jQuery , window, undefined );

