<template>


    <div class="wrap-center-middle">
        <h4>Модальное окно <br>на чистом JavaScript</h4><br>
        <button type="button" class="btn btn-lg btn-primary js-modal" data-modal="#modal_1">Открыть</button>
        <br>
        <button type="button" class="btn btn-lg btn-primary js-modal" data-modal="#modal_2">Открыть другое окно</button>
    </div>

    <!-- /.wrap-center-middle -->

    <div id="modal_1" class="modal-window">
        <div class="modal-window__title">
            <h3>Привет!</h3>
            <a href="#" class="modal-close">Закрыть</a>
        </div>
    </div>
    <!-- /#modal_1 -->

    <div id="modal_2" class="modal-window">
        <div class="modal-window__title">
            <h3>Как дела?</h3>
            <a href="#" class="modal-close">Закрыть</a>
        </div>
    </div>
    <!-- /#modal_2 -->
    <div class="modal-window__backdrop hidden" id="modal-backdrop"></div>


</template>

<script>

</script>

<style scoped lang="sass">
.wrap-center-middle
    display: flex
    align-items: center
    justify-content: center
    flex-flow: wrap column
    text-align: center
    height: 100vh

.modal-window
    position: fixed
    z-index: 100
    top: 50%
    left: 50%
    transform: translate(-50%, -80%) scale(.9)
    width: 520px
    max-width: 95%
    min-height: 200px
    box-shadow: 0 10px 30px rgba(#000, .2)
    background-color: #fff
    border-radius: 4px
    transition: all .18s ease-in-out
    visibility: hidden
    opacity: 0

    &.show
        transform: translate(-50%, -50%) scale(1)
        opacity: 1
        visibility: visible

    &__title
        display: flex
        justify-content: center
        align-items: center
        flex-flow: column wrap
        height: 100%
        min-height: inherit

    &__backdrop
        position: fixed
        top: 0
        left: 0
        width: 100%
        height: 100%
        background-color: rgba(#000, .6)

.hidden
    display: none
</style>
