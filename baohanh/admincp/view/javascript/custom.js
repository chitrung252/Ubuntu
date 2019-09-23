// JavaScript Document
          $(document).ready(function(){
          
          var keyword = $("input[name=keyword]");
            $("input[name^='product_description'],input[name='name'],input[name^='information_description'],input[name^='category_description'],input[name='title'],input[name^='elearning_description'],input[name='title'],input[name^='book_description'],input[name='title']").keyup(function(){
              var SEOlink = $("input[name^='product_description'],input[name='name'],input[name^='information_description'],input[name^='category_description'],input[name='title'],input[name^='elearning_description'],input[name='title'],input[name^='book_description'],input[name='title']").val();
              // var SEOlink = $(this).val();
                SEOlink = SEOlink.replace(/^\s+|\s+$/g, ''); // trim
                SEOlink = SEOlink.toLowerCase();
              // remove accents, swap, etc
              var from = "ẳẹừủẫồẩắểĩởềỹờầảãứấớợỷăịỳọốẻụựộỏơưửđịữễậéếũạỏiổàáäặâèéëêệìíïîòóöôùúüûñcçčlľštžýnrrd·/_,:;";
              var to   = "aeuuaoaaeioeyoaaauaooyaiyooeuuooouudiueaeeuaoioaaaaaeeeeeiiiioooouuuuncccllstzynrrd------";
              for (var i=0, l=from.length ; i<l ; i++) {
                SEOlink = SEOlink.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
              }
              SEOlink = SEOlink.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
              .replace(/\s+/g, '-') // collapse whitespace and replace by -
              .replace(/-+/g, '-'); // collapse dashes
              // return SEOlink;
			  
			  //category
             
              if ($("input[name^='category_description']").length){

                var cat_desc = $("input[name^='category_description']").val();
                  cat_desc = cat_desc.replace(/^\s+|\s+$/g, ''); // trim
                  cat_desc = cat_desc.toLowerCase();

                for (var i=0, l=from.length ; i<l ; i++) {
                  cat_desc = cat_desc.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                }
                cat_desc = cat_desc.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                .replace(/\s+/g, '-') // collapse whitespace and replace by -
                .replace(/-+/g, '-'); // collapse dashes
                if (!$("input[name^='category_description']").val()=='') { cat_desc = cat_desc+'-'; }
                // return cat_desc;
              }
			  
            if(cat_desc)
			{ 
				keyword.val(SEOlink);
			}
			else {
				keyword.val(SEOlink + '.html');
            }  
            });
        });

// VALIDATE
// addClass active menubarvar $this;
