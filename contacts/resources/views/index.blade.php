@extends('layouts.main')

@section('css')

@endsection

@section('content')
    <table id="contact_list" class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col" class="text-center">Numbers</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
           <tr class="contact-clone" hidden>
                <td class="contact-firstname"></td>
                <td class="contact-lastname"></td>
                <td class="text-center"><button type="button" class="btn btn-primary view-btn" data-id="">View</button></td>
                <td class="text-center">
                    <button type="button" class="btn btn-warning edit-btn" data-id="">Edit</button>
                    <button type="button" class="btn btn-danger delete-btn" data-id="">Delete</button>
                </td>
           </tr>
        </tbody>
    </table>
    <div id="contact_modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="contactForm" name="contactForm">
                        @csrf
                        <div class="row">
                            <div class="form-row col-sm-12 col-md-12">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label for="" class="col-form-label">Firstname: </label>
                                    <input type="text" class="form-control" id="firstname" name="contact[firstname]"/>
                                </div>
                                <div class="form-group col-sm-6 col-md-6">
                                    <label for="" class="col-form-label">Lastname: </label>
                                    <input type="text" class="form-control" id="lastname" name="contact[lastname]"/>
                                </div>
                            </div>
                            <input type="hidden" id="contact_id">
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-12">
                                <h5>Numbers: <button type="button" class="btn btn-primary btn-sm add-number-btn">Add Number</button></h5>
                                <ul class="list-group mt-3" id="contact_numbers">
                                    <li class="list-group-item number-clone" hidden>
                                        <div class="form-row col-sm-12 col-md-12">
                                            <div class="form-group col-sm-10 col-md-10">
                                                <input type="text" class="form-control" name="" placeholder="Phone no."/>
                                            </div>
                                            <div class="form-group col-sm-2 col-md-2 d-flex justify-content-center">
                                                <button type="button" class="btn btn-danger delete-number-btn">Delete</button>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item list-group-item-info number-display" hidden></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary create-btn">Create</button>
                    <button type="button" class="btn btn-primary save-btn">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
@endsection