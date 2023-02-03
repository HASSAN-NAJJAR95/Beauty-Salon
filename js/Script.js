$(function (){
    function videoToggle(){
        video= $('.beauty').get(0)
        if(video.paused){
            video.play();
            $('.video-control-play').hide();
            $('.video-control-pause').show();
        }else{
            video.pause();
            $('.video-control-pause').hide();
            $('.video-control-play').show();
        }
    } 
    $('.video-control-play').click(function(){
        videoToggle();
    });
    $('.video-control-pause').click(function(){
        videoToggle();
    });
});