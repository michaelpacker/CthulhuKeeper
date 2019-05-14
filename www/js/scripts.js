$(document).ready(function() {
    $('.menuToggle').click(function(e) {
        $('.pageWrap').toggleClass('open close');
        $('header h1').toggleClass('open close');
    });
});

$(document).ready(function() {

    // Add and Remove Specialization Rows
    $('.js-repeatableRows').on('click','.js-addRow', function(e) {
         // Get the id and data-count of the parent table
        var thisRow     = $(this).closest('tr');
        var thisRowBody = thisRow.closest('tbody');
        var specID      = thisRow.closest('.js-repeatableRows').attr('id');
        var nextRow     = '';
        var count;
        var countAdd;

        if (specID != 'additionalSkills') {
            count = thisRow.closest('.js-repeatableRows').attr('data-count');
            
            var defScore;
            var specDataID;
            
            // Define base values
            switch(specID) {
                case "art_craft": // None
                    defScore = 1;
                    specDataID = 1;
                    break;
                case "fighting": // Don't enter at all if none
                    defScore = 0;
                    specDataID = 2;
                    break;
                case "firearms": // Don't enter at all if none
                    defScore = 0;
                    specDataID = 3;
                    break;
                case "language_other": // lang (other)
                    defScore = 1;
                    specDataID = 4;
                    break;
                case "science": // None
                    defScore = 1;
                    specDataID = 5;
                    break;
                case "survival": // None
                    defScore = 10;
                    specDataID = 6;
                    break;
                default:
                    break;
            }
            
            count++;
            thisRow.closest('.js-repeatableRows').attr('data-count', count);

            nextRow = "<tr data-name='" + count + "' class='" + specID + "_entry'>";
            nextRow += "<td class='skillName'>";
            nextRow += "<input type='hidden' name='spec_skID[]' value='" + specDataID + "'>";
            nextRow += "<input type='text' id='skill_" + specID + "_spec_" + count + "' class='js-spec_skill' name='spec_name[]' required aria-required='true' aria-labelledby='" + specID + "_c1'>";
            nextRow += "</td><td class='skillScore'>";
            nextRow += "<input type='number' id='skill_" + specID + "_score_"+ count +"' class='js-spec_score' name='spec_score[]' value='"+ defScore +"' aria-labelledby='" + specID + "_c2' min='"+ defScore +"' max='99'>";
            nextRow += "</td><td>";
            nextRow += "<button type='button' class='js-removeSpecRow css-addRemove'><span class='fa fa-minus-circle icon'></span><span class='visually-hidden'> Remove specialization</span></button>";
            nextRow += "</td>";
            nextRow += "</tr>";
        } else {
            // Deal with additional skills
            countAdd = thisRow.closest('.js-repeatableRows').attr('data-count');
            // Increment the count
            countAdd++;
            thisRow.closest('.js-repeatableRows').attr('data-count', countAdd);
            
            nextRow = "<tr class='additional_skill_entry'>"
            nextRow += "<td class='skillName'>"
            nextRow += "<input type='text' id='skill_additional_" + countAdd +"' class='js-add_skill' name='add_skill_name[]' aria-labelledby='add_skill_c1'>";
            nextRow += "</td><td class='skillScore'>";
            nextRow += "<input type='number' id='skill_additional_score_" + countAdd +"' class='js-add_score' name='add_skill_score[]' min='0' max='99'>";
            nextRow += "</td><td>";
            nextRow += "<button type='button' class='js-removeSpecRow css-addRemove'><span class='fa fa-minus-circle icon'></span><span class='visually-hidden'> Remove specialization</span></button>";
            nextRow += "</td>";
            nextRow += "</tr>";

        }

        $(thisRowBody).append(nextRow);

        // find out what specialization we're on
    });

    $('.js-repeatableRows').on('click', '.js-removeSpecRow', function(e) { 
        // Get the id and data-count of the parent table
        var thisRow = $(this).closest('tr');
        var specID  = thisRow.closest('.js-repeatableRows').attr('id');
        var count   = thisRow.closest('.js-repeatableRows').attr('data-count');

        var thisBody = thisRow.closest('tbody.repeatingRows');        
       
        // Reset the primary tabel count
        count--;
        thisRow.closest('.js-repeatableRows').attr('data-count', count);
        thisRow.remove();

        // Now update each row in the table
        var theseRows = thisBody.find('tr');
        var k = 1;
        $(theseRows).each(function() {
            $(this).attr('data-name',k);
            // find the specialty name id
            // update that
            var newTxtID = "skill_" + specID + "_spec_" + k;
            var newScrID = "skill_" + specID + "_score_" + k;
            $(this).find('input[type="text"]').attr({
                id: newTxtID
            });
            $(this).find('input[type="number"]').attr({
                id: newScrID
            });
            k++;
        });


    });

    // If someone has entered a value into the name field, enable score
    var skillBaseValue = 0;
    $('.js-add_skill').on('change', function(e) {
            var thisRow = $(this).closest('tr');
            var scoreField = $(thisRow).find('.js-add_score');
            var addButton = $(thisRow).find('.js-addRow');
            var ogVal = scoreField.attr('value');

        if ($(this).val() == '') {
            // Set the value of 'score' to its original value
            scoreField.prop('readonly','true');
            scoreField.val(ogVal);
            addButton.prop('disabled','true');
        } else {
            scoreField.removeAttr('readonly');
            addButton.removeAttr('disabled');
        }
    }); // Works for non-dynamic fields


    // Players may not add additional specializations unless the first is completed
    // I'll figure this out
    
    

    // CALC SECONDARY STATS
    
    $('.characterCreate').on('click','.js-calcSecStats', function(e) {
        // get values from appropriate fields
        // pass to function


    });



});



// Handle calculation of secondary stats
$(document).ready(function() {

    // Handle click
    // Click gets info
    // passes info to distinct functions
    // each fun
    var char_str = '';
    var char_siz = '';
    var char_con = '';
    var char_dex = '';
    var char_pow = '';
    var char_age = '';

    
    var char_db = '';
    
    var char_san = '';

    // Calc Move Score
    function calcMove(str,sz,dex,age) {
        
        var char_move = 0;

        if ((str < sz) && (dex < sz)) {
            char_move = 7;
        } else if ((str >= sz) || (dex >= sz)) {
            char_move = 8;
        } else if ((str > sz) && (dex > sz)) {
            char_move = 9;
        }
        
        switch (true) {
            case age < 40:
                break;
            case age < 50:
                char_move = char_move -1;
                break;
            case age < 60:
                char_move = char_move -2;
                break;
            case age < 70:
                char_move = char_move -3;
                break;
            case age < 80:
                char_move = char_move - 4;
                break;
            case age < 100:
                char_move = char_move -5;
                break;
            default:
                break;
        }
        
        // Place the score
        $('#moveScore').val(char_move);
    }

    // Calc Build Score
    function calcDBBuild(str,siz) {
        var x = str + siz;
        var char_damage_bonus = '';
        var char_build = '';

        switch (true) {
            case x <= 64:
                char_damage_bonus = '-2';
                char_build = '-2';
                break;
            case x <= 84:
                char_damage_bonus = '-1';
                char_build = '-1';
                break;
            case x <= 124:
                char_damage_bonus = '0';
                char_build = '0';
                break;
            case x <= 164:
                char_damage_bonus = '+1D4';
                char_build = '+1';
                break;
            case x <= 204:
                char_damage_bonus = '+1D6';
                char_build = '+2';
                break;
            case x <= 284:
                char_damage_bonus = '+2D6';
                char_build = '+3';
                break;
            case x <= 364:
                char_damage_bonus = '+3D6';
                char_build = '+4';
                break;
            case x <= 444:
                char_damage_bonus = '+4D6';
                char_build = '+5';
                break;
            case x <= 524:
                char_damage_bonus = '+5D6';
                char_build = '+6';
                break;
            default:
                break;
        }

        // Place the score
        $('#damageBonusScore').val(char_damage_bonus);
        $('#buildScore').val(char_build);
    }

    // Calc Hit Points
    function calcHitPoints(con,siz) {
        var char_hp = '';
        var base_hp = con + siz;
        char_hp = Math.round(base_hp / 10);
        $('#hitpointsScore').val(char_hp);

    }

    function calcMagicPoints(pow) {
        var char_mp = pow / 5;
        char_mp = Math.floor(char_mp);
        $('#magicpointsScore').val(char_mp);
    }

    // magicPointsScore
    // sanityScore

    $('.characteristics.secondary').on('click','.js-calcSecStats', function() {
        // str, siz, con, dex age , pow move*
        char_str = $('#strengthScore').val();
        char_str = parseInt(char_str);
        char_siz = $('#sizeScore').val();
        char_siz = parseInt(char_siz);
        char_con = $('#constitutionScore').val();
        char_con = parseInt(char_con);
        char_dex = $('#dexterityScore').val();
        char_dex = parseInt(char_dex);
        char_pow = $('#powerScore').val();
        char_pow = parseInt(char_pow);
        char_age = $('#characterAge').val();
        char_age = parseInt(char_age);        
        
        calcDBBuild(char_str,char_siz);
        calcHitPoints(char_con,char_siz);
        calcMove(char_str,char_siz,char_dex,char_age);
        calcMagicPoints(char_pow);
        
            char_san = char_pow;
            $('#sanityScore').val(char_san);
    });


});

