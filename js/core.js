$(document).ready(function() {
    function confirmer() {
        if (confirm("Bы уверены?")) {
            return true;
        }
    }

    $('#date').hide(); //Сразу скрываем выбор дат
    $('#type').change(function() { //При изменении селекта
        type=($(this).val()); //Присваеваем переменной значение option
        if (type==3) { //Если выбран 3тип отчета
            $('#date').show(); //Показываем выбор дат
        } else { //Если нет
            $('#date').hide(); //То скрываем
        }
    });

    $('#parse').click(function() {
        if (confirmer()) {
            $('#msgParse').html('');
            $.post("action.php", {
                    act : 'parse'
                },
                onAjaxSuccess
            );
            function onAjaxSuccess(data)
            {
                $('#msgParse').html(data);
            }
        }
    });
    $('#send').click(function() {
        if (confirmer()) {
            type= $("#type").val();
            mail = $("input[name='mail']").val();
            date1=$("select[name='date1']").val();
            date2=$("select[name='date2']").val();
            date3=$("select[name='date3']").val();
            date12=$("select[name='date12']").val();
            date22=$("select[name='date22']").val();
            date32=$("select[name='date32']").val();
            if (mail.length!=0){
                $.post("action.php", {
                        act : 'sendMail',
                        type : type, mail : mail, date1 : date1, date2 : date2, date3 : date3,
                        date12 : date12, date22 : date22, date32 : date32
                    },
                    onAjaxSuccess
                );
            } else {
                alert('Введите eMail');
            }
            function onAjaxSuccess(data)
            {
                $('#msgSend').html(data);
            }
        }
    });
});
