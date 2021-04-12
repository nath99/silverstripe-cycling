$Content

<div class="flex">
    <div class="column">
        <h3>Upcoming Races</h3>
        <% if $UpcomingRaces %>
            <% loop $UpcomingRaces %>
                <p><a href="{$Link}">{$Title}</a></p>
              <% end_loop %>
        <% else %>
            <p>No upcoming races.</p>
        <% end_if %>
    </div>
    <div class="column">
        <h3>Completed Races</h3>
        <% if $CompletedRaces %>
            <% loop $CompletedRaces %>
                <p><a href="{$Link}">{$Title}</a></p>
              <% end_loop %>
        <% else %>
            <p>No completed races.</p>
        <% end_if %>
    </div>
</div>
