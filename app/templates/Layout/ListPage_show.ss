<p><a href="{$BaseHref}">Return to race list</a></p>
<h1>{$Race.Title}</h1>
<% if $Race.Completed %>
    Race Completed on: {$Race.RaceDate.format('dd MMMM y hh:mma')}
<% else %>
    Race scheduled on: {$Race.RaceDate.format('dd MMMM y hh:mma')}
<% end_if %>

<% if $Race.Riders %>
    <% if $Race.Complete %>
        <h3>Results</h3>
        <ol>
    <% else %>
        <h3>Race Entrants</h3>
        <ul>
    <% end_if %>
    <% loop $Race.Riders.Sort('Position') %>
        <li>{$FirstName} {$Surname}</li>
    <% end_loop %>
    <% if $Race.Complete %>
        </ol>
    <% else %>
        </ul>
    <% end_if %>
<% end_if %>
