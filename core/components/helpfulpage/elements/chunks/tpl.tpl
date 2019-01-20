<div class="helpfulPage" data-page="{$_modx->resource.id}" >
    <div class="helpfulPageInfo" >
        <h4 >Эта страница полезна?</h4>
        <a href="#" data-action="vote_for" class="btn btn-lg btn-secondary mr-2">Да</a>
        <a href="#" data-action="vote_aganist" class="btn btn-lg btn-secondary">Нет</a>
        <p >Эта страницу считают полезной <span id="helpfulPageStat">0</span>% клиентов</p>
    </div>

    <form  class="helpfulPageForm"  hidden>
        <textarea class="form-control" name="message" placeholder="Напишите здесь ваши замечания и предложения. Если вам необходима помощь по странице, оставьте ваши контакты: имя и телефон/e-mail в этом поле."></textarea>
        <input type="hidden" name="resource_id" value="{$_modx->resource.id}">
        <input type="hidden" name="action" value="helpfulPageMessage">
        <div class="mt-3">
            <button class="btn btn-lg btn-primary mr-2">Отправить</button>
            <button type="button" class="btn btn-lg btn-secondary closeHelpfulPageForm">Отменить</button>
        </div>
    </form>

    <div class="helpfulPageSuccess" hidden><p>Благодарим за оставленный Вами отзыв! Мы стараемся становиться лучше!</p></div>
    <div class="helpfulPageError" hidden><p></p></div>
</div>