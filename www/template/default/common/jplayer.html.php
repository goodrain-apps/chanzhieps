<?php if(!defined("RUN_MODE")) die();?>
<?php js::import($jsRoot . 'jplayer/dist/jplayer/jquery.jplayer.min.js');?>
<?php css::import($jsRoot . 'jplayer/dist/skin/blue.monday/css/jplayer.blue.monday.min.css');?>
 
<script type="text/javascript">
$(document).ready(function()
{
    $('embed').hide();
    $('embed').each(function(index)
    {
        src = $(this).attr('src');
        w = $(this).width();
        h = $(this).height();
        containerID = "media_container_" + index;
        id = "media_" + index;
        
        var reg = /\.flv$|\.flv\?|\.webm$|\.webm\?|\.wmv$|\.rtmp\?|\.rtmp$|\.mp3\?|\.mp3$|\.ogg\?|\.ogg$|\.mp4\?|\.mp4$|\.mp4\?/;
        mediaType = reg.exec(src);

        if(mediaType)
        {
            mediaType = mediaType.toString().replace('.', '');
            mediaType = mediaType.toString().replace('?', '');
            mediaTypeList = <?php echo json_encode($this->config->file->mediaTypes);?>;
            mediaType = eval("mediaTypeList." + mediaType.toLowerCase());
        }

        if(mediaType && typeof(eval("mediaTypeList." + mediaType.toLowerCase())) == 'string')
        {
            $(this).replaceWith("<div id='" + id + "'  class='jp-player text-center' data-src='" + src + "' style='margin: 0 auto;'></div>");
            $('#' + id).wrap("<div class='jp-type-single'></div>");
            $('#' + id).parent().wrap("<div id='" + containerID  + "' class='jp-video jp-video-360p' style='width: " + (w + 2) + "px' role='application' aria-label='media player'></div>");
            $('#' + id).after($('#playerBar').html());

            mediaSetting = {};
            mediaSetting.title = '';
            eval("mediaSetting." + mediaType + " = '" + src + "'");
            
            $('#' + id).jPlayer(
            {
                ready: function () { $(this).jPlayer("setMedia", mediaSetting); },
                play: function() { $(this).jPlayer("pauseOthers"); },
                swfPath: "/js/jplayer/dist/jplayer",
                supplied: mediaType,
                size: { width: w, height: h, cssClass: "jp-video-720p" },
                useStateClassSkin: true,
                autoBlur: false,
                smoothPlayBar: true,
                keyEnabled: true,
                remainingDuration: true,
                cssSelectorAncestor: '#' + containerID,
                toggleDuration: true
            });
        }
        else
        {
            $(this).show();
        }
    })
});
</script>
<div class="hide jp-video jp-video-360p" role="application" aria-label="media player">
	<div class="jp-type-single" id='playerBar'>
        <div class="jp-gui">
          <div class="jp-video-play">
            <button class="jp-video-play-icon" role="button" tabindex="0">play</button>
          </div>
			<div class="jp-interface">
				<div class="jp-progress">
					<div class="jp-seek-bar">
						<div class="jp-play-bar"></div>
					</div>
				</div>
				<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
				<div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
				<div class="jp-controls-holder">
					<div class="jp-controls">
						<button class="jp-play" role="button" tabindex="0">play</button>
						<button class="jp-stop" role="button" tabindex="0">stop</button>
					</div>
					<div class="jp-volume-controls">
						<button class="jp-mute" role="button" tabindex="0">mute</button>
						<button class="jp-volume-max" role="button" tabindex="0">max volume</button>
						<div class="jp-volume-bar">
							<div class="jp-volume-bar-value"></div>
						</div>
					</div>
					<div class="jp-toggles">
						<button class="jp-repeat" role="button" tabindex="0">repeat</button>
						<button class="jp-full-screen" role="button" tabindex="0">full screen</button>
					</div>
				</div>
				<div class="jp-details">
					<div class="jp-title" aria-label="title">&nbsp;</div>
				</div>
			</div>
		</div>
		<div class="jp-no-solution">
			<span>Update Required</span>
			To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
		</div>
	</div>
</div>
