@extends('main')
@section('title','| Contact')
@section('content')
 <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Contact Us</h3></div>
                <div class="panel-body">
          <form>
            <div class="form-group">
              <label name="email">Email:</label>
              <input id="email" name="email" type="email" class="form-control" required="">
            </div>

            <div class="form-group">
              <label name="subject">Subject:</label>
              <input id="subject" name="subject" class="form-control" required="">
            </div>

            <div class="form-group">
              <label name="message">Message:</label>
              <textarea id="message" name="message" class="form-control" placeholder="Type your message here..."required=""></textarea>
            </div>
            <div class="form-group">
<strong>Captcha:</strong>
{!! app('captcha')->display()!!}
{!! $errors->first('g-recaptcha-response','<p class="alert alert-danger">:message</p>')!!}
</div>
<div class="form-group">
 <button type="submit" class="btn btn-default btn-block"><span class="glyphicon glyphicon-envelope"></span> Send Message</button>
        </div>  
          </form>
        </div>
      </div>
      </div>
      </div>

      @endsection
