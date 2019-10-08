//Helper Functions:
function boldenedString(main,sub){
    let pos=main.toLowerCase().indexOf(sub.toLowerCase());
    return main.substr(0,pos)+'<strong>'+main.substr(pos,sub.length)+'</strong>'+main.substr(pos+sub.length);
}

function construct_skill_object(skill_arr){
    children={};
    children[-1]=[];
    for(ele in skill_arr){
        if(skill_arr[ele].parent!==null){
            if(children.hasOwnProperty(skill_arr[ele].parent)){
                children[skill_arr[ele].parent].push({"skillid":skill_arr[ele].skillid,"skill":skill_arr[ele].skill});
            }
            else{
                children[skill_arr[ele].parent]=[{"skillid":skill_arr[ele].skillid,"skill":skill_arr[ele].skill}];
            }
        }
        else{
            children[-1].push({"skillid":skill_arr[ele].skillid,"skill":skill_arr[ele].skill});
        }
    }
    return children;
}

function construct_child_string(skill_obj, id){
    if(!skill_obj.hasOwnProperty(id))
        return '';
    let f='<ul>';
    for(x in skill_obj[id]){
        f+='<li>'+skill_obj[id][x].skill+'</li>';
        f+=construct_child_string(skill_obj,skill_obj[id][x].skillid);
    }
    f+='</ul>';
    return f;
}

function create_alert_string(message, alertClass, id){
    f='<div class="alert alert-'+ alertClass + ' alert-dismissible fade show" role="alert" id="' + id + '">' +
        message +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span>' +
        '</button>' +
    '</div>';
    return f;
}


$(document).ready(function()
{
    //For listing User's skills
    function showMySkills(skill_list_json){
        skill_list_array=JSON.parse(skill_list_json);
        skill_object=construct_skill_object(skill_list_array);
        let f='<ul>';
        for(x in skill_object[-1]){
            f+='<li>'+skill_object[-1][x].skill+'</li>';
            f+=construct_child_string(skill_object,skill_object[-1][x].skillid);
        }
        f+='</ul>';
        $('.skill-show').html(f);
    }
    $.get("async/skills_async.php",{showMy:true}).done(showMySkills);



    //for searching skills
    $('.search-box input[type="text"]').on("input", function()
    {
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        resultDropdown.empty();
        if(inputVal.length)
        {
            $.get("async/skills_async.php", {skillSearch: inputVal}).done(function(skill_suggest_json)
            {
                skill_suggest_array=JSON.parse(skill_suggest_json);
                if(skill_suggest_array.length===0)
                {
                    resultDropdown.html('<p>There are no skills like \"<em>'+inputVal+'</em>\"</p>')
                }
                else
                {
                    for(x in skill_suggest_array)
                    {
                        if(resultDropdown.html())
                            resultDropdown.html(resultDropdown.html()+'<p id=\"skilloption\">'+boldenedString(skill_suggest_array[x].skill,inputVal)+'</p>');
                        else
                            resultDropdown.html('<p id=\"skilloption\">'+boldenedString(skill_suggest_array[x].skill,inputVal)+'</p>');
                    }
                }
            });
        }
    });

    $(document).on("click",".result p#skilloption", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });


    // For clearing the list when other part of document is clicked:
    function closeAllLists(element){
        var x = document.getElementsByClassName("result");
        for (i in x){
            if (element!=x[i]) {
                x[i].innerHTML="";
            }
        }
    }
    document.addEventListener("click",function(e){
        closeAllLists(e.target);
    });


    // For Adding a new Skill:
    $('#skillAddBtn').click(function(){
        var skillName = $('.search-box input[type="text"]').val();
        $.get("async/skills_async.php",{addSkill:skillName}).done(function(result_json){
            let result=JSON.parse(result_json);
            if(!result.executed){
                if(result.validSkill===true){
                    if(result.errorInfo[1]===1062){
                        $('.search-box').parent().parent().parent().append(
                            create_alert_string(skillName + ' is already registered to you!','warning','search-alert')
                        );
                        $("#search-alert").css("margin","10px 0px");
                        return;
                    }
                }
                $('.search-box').parent().parent().parent().append(
                    create_alert_string('SQL ERROR! Contact Developers.','primary','search-alert')
                );
                $("#search-alert").css("margin","10px 0px");
            }
            else if(result.validSkill===false){
                $('.search-box').parent().parent().parent().append(
                    create_alert_string(skillName + ' is not a valid Skill!','danger','search-alert')
                );
                $("#search-alert").css("margin","10px 0px");
            }
            else if(result.errorInfo===null){
                $('.search-box').parent().parent().parent().append(
                    create_alert_string('Skill \"'+skillName+'\" Added Successfully','success','search-alert')
                );
                $("#search-alert").css("margin","10px 0px");
                // Reload My SKills:
                $.get("async/skills_async.php",{showMy:true}).done(showMySkills);
            }

        });
    });
});
