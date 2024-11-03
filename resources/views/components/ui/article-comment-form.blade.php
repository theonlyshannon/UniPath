<form action="{{ route('app.article.comment.store', $article->slug) }}" method="POST" class="comments-form__form form-one">
    @csrf
    <div class="form-one__group">
        <div class="form-one__control">
            <input type="text" name="name" placeholder="Nama" value="{{ Auth::check() ? Auth::user()->student?->name : '' }}">
        </div>
        <div class="form-one__control">
            <input type="email" name="email" placeholder="Your Email"  value="{{ Auth::check() ? Auth::user()->email : ''}}">
        </div>
        <div class="form-one__control form-one__control--full">
            <textarea placeholder="Komentar Anda" name="comment" required></textarea>
        </div>
        <div class="form-one__control form-one__control--full">
            <button type="submit" class="comments-form__btn eduhive-btn eduhive-btn--normal"><span>Post
                    Comment</span></button>
        </div>
    </div>
</form>
