<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 11/1/2018
 * Time: 3:19 PM
 */

?>
<div class="modal fade" id="_modalDeleteConfirm" tabindex="-1" role="dialog" aria-labelledby="modalDeleteConfirm" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content" method="post">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteConfirm">Modal Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                คุณต้องการลบข้อมูล
                <p id="modalDeleteConfirm_message"></p>

                <hr>
                <input id="modalDeleteConfirm_checkbox" type="checkbox" value="Y" onchange="checkboxConfirmDelete();" > ยืนยันการลบข้อมูล
            </div>
            <div class="modal-footer">
                <input id="modalDeleteConfirm_id" name="delete_id" value="" hidden>
                <input id="modalDeleteConfirm_fn" name="fn" value="" hidden>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="modalDeleteConfirm_btn" type="submit" class="btn btn-primary" disabled>Delete Data ...</button>
            </div>
        </form>
    </div>
</div>
<script>

    function checkboxConfirmDelete() {
        var check = $('#modalDeleteConfirm_checkbox').prop('checked');
        if(check){
            $('#modalDeleteConfirm_btn').removeAttr('disabled');
        }else {
            $('#modalDeleteConfirm_btn').attr('disabled',true);
        }
    }

    function setModalDelete(fn,text,id) {
        $('#modalDeleteConfirm_message').html(text);
        $('#modalDeleteConfirm_fn').attr('value',fn);
        $('#modalDeleteConfirm_id').attr('value',id);

        $("#_modalDeleteConfirm").modal();
    }
</script>

