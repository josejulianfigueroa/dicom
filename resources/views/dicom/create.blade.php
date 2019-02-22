@extends('materialdesign.mastermaterial')
@section('title', 'Cargar DICOM')

@section('content')
<div class="container">
    <h2>Laravel Ajax Validation</h2>

    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>

    <form>
        {{ csrf_field() }}
        <div class="form-group">
            <label>First Name:</label>
            <input type="text" name="first_name" class="form-control" placeholder="First Name">
        </div>

        <div class="form-group">
            <label>Last Name:</label>
            <input type="text" name="last_name" class="form-control" placeholder="Last Name">
        </div>

        <div class="form-group">
            <strong>Email:</strong>
            <input type="text" name="email" class="form-control" placeholder="Email">
        </div>

        <div class="form-group">
            <strong>Address:</strong>
            <textarea class="form-control" name="address" placeholder="Address"></textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-success btn-submit">Submit</button>
        </div>
    </form>
</div>



</body>
</html>
@endsection
