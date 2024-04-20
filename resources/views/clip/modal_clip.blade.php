<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <form action="{{ route('punto_venta.clip') }}" method="POST">
            @csrf

            <input type="number" class="form-control" name="amount" placeholder="amount">
            <input type="text" class="form-control" name="assigned_user" placeholder="assigned_user">
            <input type="text" class="form-control" name="reference" placeholder="reference">
            <input type="text" class="form-control" name="message" placeholder="message">

            <input type="submit" value="submit" class="btn btn-primart btn-sm">

          </form>
        </div>



      </div>
    </div>
