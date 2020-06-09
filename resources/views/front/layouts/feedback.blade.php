<section class="feedback" id="feedback">
    <div class="container">
        <h2 class="section-title">Оставить заявку</h2>

        <div class="row">

            <div class="offset-xl-0 offset-lg-1 col-lg-8 col-12">
                <div class="form-wrapper">
                    <h4 class="form-wrapper__title">Остались вопросы?</h4>
                    <div class="form-wrapper__subtitle">Отправьте их нам!</div>
                    <form action="{{ route('feedback.create') }}" method="post">
                        @csrf
                        <input type="text" name="name" required placeholder="Ваше имя">
                        <input type="email" name="email" placeholder="Ваш e-mail">
                        <input type="tel" name="phone_number" required placeholder="Ваш номер">
                        <textarea name="question" id="" cols="50" rows="4" placeholder="Ваш вопрос"></textarea>
                        <button class="form__btn" type="submit">Отправить</button>
                    </form>
                </div>
            </div>
            <!-- /.col-8 -->

            <div class="offset-xl-0 col-xl-4 col-lg-6 offset-md-3 col-md-7 offset-sm-1 col-sm-9 offset-1 col-10">
                <div class="contacts">
                    <h4 class="contacts__title">Наши контакты</h4>
                    <div class="contacts__subtitle">Позвоните нам!</div>
                    <div class="contacts__block">
                        <div class="contacts__time-img"></div>
                        <div class="contacts__time">{{$contact->time}}</div>
                    </div>
                    <div class="contacts__block">
                        <div class="contacts__mail-img"></div>
                        <div class="contacts__mail"><a href="mailto:{{$contact->email}}">{{$contact->email}}</a></div>
                    </div>
                    <div class="contacts__block">
                        <div class="contacts__geo-img"></div>
                        <div class="contacts__geo">{{$contact->address}}</div>
                    </div>
                    <div class="contacts__block">
                        <div class="contacts__phone-img"></div>
                        <div class="contacts__phone">{{$contact->number}}</div>
                    </div>
                </div>
                <!-- /.contacts -->
            </div>
            <!-- /.col-4 -->

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /#feedback.feedback -->
