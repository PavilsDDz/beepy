
$( function() {
  $( "#year-range" ).slider({
    range: true,
    min: 1970,
    max: 2017,
    values: [ 1970, 2017 ],
    slide: function( event, ui ) {
      $( "#year_from" ).val(ui.values[ 0 ]);
      $( "#year_to" ).val(ui.values[ 1 ]);
    }
  });
     //$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
     //  " - $" + $( "#slider-range" ).slider( "values", 1 ) );



  $( "#millage-range" ).slider({
    range: true,
    min: 0,
    max: 300000,
    values: [ 0, 300000 ],
      slide: function( event, ui ) {
        $( "#millage_from" ).val(ui.values[ 0 ]);
        $( "#millage_to" ).val(ui.values[ 1 ]);
      }
    });
     //$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
     //  " - $" + $( "#slider-range" ).slider( "values", 1 ) );


  $( "#price-range" ).slider({
    range: true,
    min: 0,
    max: 300000,
    values: [ 0, 300000 ],
      slide: function( event, ui ) {
        $( "#price_from" ).val(ui.values[ 0 ]);
        $( "#price_to" ).val(ui.values[ 1 ]);
      }
    });

   $( "#engine-range" ).slider({
    range: true,
    min: 0,
    max: 300000,
    values: [ 0, 300000 ],
      slide: function( event, ui ) {
        $( "#engine_from" ).val(ui.values[ 0 ]);
        $( "#engine_to" ).val(ui.values[ 1 ]);
      }
    });

      $( "#engineCapacity-range" ).slider({
    range: true,
    min: 0.1,
    max: 8,
    step:0.1,
    values: [ 0.1, 8 ],
      slide: function( event, ui ) {
        $( "#engineCapacity_from" ).val(ui.values[ 0 ]);
        $( "#engineCapacity_to" ).val(ui.values[ 1 ]);
      }
    });

     //$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
     //  " - $" + $( "#slider-range" ).slider( "values", 1 ) );
});




   