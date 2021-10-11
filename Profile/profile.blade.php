@extends('layouts.main')

@section('center')
    <div class="col-sm-6">
        <div class="text-center">
            <img class="img-circle" src="images/user_8/image_1619243210.jpeg" height="200" width="300">
            <br><br>
        </div>

        <table style="width:100%" class="table table-striped">
            <tr>
                <td><strong>First Name</strong></td>
                <td id="f_name">Test Name</td>
                <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="setField('f_name');">
                        Edit
                    </button>
                </td>
            </tr>
            <tr>
                <td><strong>Last Name</strong></td>
                <td id="l_name">Test Name</td>
                <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="setField('l_name');">
                        Edit
                    </button>
                </td>
            </tr>
            <tr>
                <td><strong>Username</strong></td>
                <td id="username">test_username</td>
                <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="setField('username');">
                        Edit
                    </button>
                </td>
            </tr>
            <tr>
                <td><strong>Email</strong></td>
                <td id="email">raju@raju.com</td>
                <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="setField('email');">
                        Edit
                    </button>
                </td>
            </tr>
            <tr>
                <td><strong>Phone</strong></td>
                <td id="phone">0123456789</td>
                <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="setField('phone');">
                        Edit
                    </button>
                </td>
            </tr>
        </table>
    </div>

    <div class="modal fade bd-example-modal-sm" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalLongTitle"><b>Edit</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <h4><label id="field_name" class="pull-right"></label></h4>
                                <input type="hidden" value="" name="field_name">
                            </div>
                            <div class="col-sm-8">
                                <input type="text" value="" id="field_value">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection

