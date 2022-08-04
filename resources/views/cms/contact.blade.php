@extends('layouts.app')

@section('css')
<style>
    .contact {
  min-height: calc(100vh - 300px);
  padding-top: 30px;
  padding-bottom: 10px;
}
</style>
@endsection

@section('content')
<div class="contact">
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <h1>Get In Touch</h1>
          <p>
            Paragraph text comes here. Lorem Ipsum is simply dummy text of the
            printing and typesetting industry.
          </p>

          <div class="mt-5 mb-4">
            <h6>Email</h6>
            <p>test@email.com</p>
          </div>
          <div class="my-4">
            <h6>Phone Number</h6>
            <p>+234 (0) 123 478 7535</p>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-6">
          <form action="">
            <div class="row gx-3 mb-4">
              <p class="mb-0">Name <sup>*</sup></p>
              <div class="col-md-6">
                <div class="form-group">
                  <label for=""></label>
                  <input
                    type="text"
                    name=""
                    id=""
                    class="rounded-0 form-control form-control-lg"
                    placeholder=""
                    aria-describedby="helpId"
                  />
                  <small id="helpId" class="text-muted">First Name</small>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for=""></label>
                  <input
                    type="text"
                    name=""
                    id=""
                    class="rounded-0 form-control form-control-lg"
                    placeholder=""
                    aria-describedby="helpId"
                  />
                  <small id="helpId" class="text-muted">First Name</small>
                </div>
              </div>
            </div>
            <div class="form-group mb-4">
              <p for="">Email Address</p>
              <input
                type="text"
                name=""
                id=""
                class="rounded-0 form-control form-control-lg"
                placeholder=""
                aria-describedby="helpId"
              />
            </div>
            <div class="form-group">
              <p for="">Message</p>
              <textarea
                class="form-control form-control-lg rounded-0"
                name=""
                id=""
                rows="3"
              ></textarea>
            </div>
            <a class="btn btn-dark rounded-0 px-4 py-3 mt-4" href="#"
              >Send Message</a
            >
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
