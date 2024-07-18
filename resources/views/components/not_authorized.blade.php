<!-- resources/views/modals/unauthorized_modal.blade.php -->

<div id="unauthorizedModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p>Yetkiniz bulunmamaktadır.</p>
    </div>
</div>

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