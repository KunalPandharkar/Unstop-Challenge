@extends('Layouts.MainLayout')

@section('content')
    {{-- Book Ticket Card --}}
    <div class="book-ticket-div"
        style=" background: url('{{ asset('assets/images/vandebharat.webp') }}') no-repeat center center fixed;background-size: cover;">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center mb-4">Book Tickets</h5>
                {{-- Book Tickets Form --}}
                <form action="{{ route('book-tickets') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="username" class="form-label">Enter Number of Tickets </label>
                        <input type="number" required class="form-control" name="tickets-input" id="tickets-input"
                            placeholder="one person can book upto 7 tickets.">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block book-now-btn">Book Now</button>
                </form>
            </div>

            <button type="button" class="btn btn-dark reset-all-btn"  data-bs-toggle="modal" data-bs-target="#resetModal">RESET ALL
                PROGRESS</button>

        </div>
    </div>

    <!--Reset DB Modal -->
    <div class="modal fade" id="resetModal" tabindex="-1" aria-labelledby="resetModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
              
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>This will reset all the booked seats to 0.</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"  onclick="location.href='{{route('reset-all')}}'">CONFIRM DELETE</button>
                </div>
            </div>
        </div>
    </div>
    
    {{-- boostrap js for modal functionality --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection
