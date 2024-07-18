<!-- resources/views/errors/unauthorized_modal.blade.php -->


<div id="unauthorizedModal" class="modal" style="display: block;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p>Yetkiniz bulunmamaktadır.</p>
    </div>
</div>

<style>
    /* Modal stilini burada tanımlayabilirsiniz */
    .modal {
        display: block;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
    }

    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<script>
    function openModal() {
        var modal = document.getElementById("unauthorizedModal");
        if (modal) {
            modal.style.display = "block";
        }
    }

    function closeModal() {
        var modal = document.getElementById("unauthorizedModal");
        if (modal) {
            modal.style.display = "none";
        }
    }
</script>

