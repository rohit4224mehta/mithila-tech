@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Submit Feedback</h1>
            <div class="card">
                <div class="card-header">Feedback Form</div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="project" class="form-label">Select Project</label>
                            <select class="form-select" id="project">
                                <option>Website Redesign</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="feedback" class="form-label">Feedback</label>
                            <textarea class="form-control" id="feedback" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Feedback</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
