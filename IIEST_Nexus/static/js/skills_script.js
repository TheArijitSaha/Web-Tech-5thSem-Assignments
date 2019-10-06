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



$(document).ready(function()
{
    //For listing User's skills
    $.get("async/skill_user_list.php").done(function(skill_list_json)
    {
        skill_list_array=JSON.parse(skill_list_json);
        skill_object=construct_skill_object(skill_list_array);
        let f='<ul>';
        for(x in skill_object[-1]){
            f+='<li>'+skill_object[-1][x].skill+'</li>';
            f+=construct_child_string(skill_object,skill_object[-1][x].skillid);
        }
        f+='</ul>';
        $('.skill-show').html(f);
    });

    //for searching skills
    $('.search-box input[type="text"]').on("input", function()
    {
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        resultDropdown.empty();
        if(inputVal.length)
        {
            $.get("async/skill_suggest.php", {skillSearch: inputVal}).done(function(skill_suggest_json)
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

});
