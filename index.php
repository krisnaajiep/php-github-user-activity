<?php

require_once 'functions.php';

if (isset($argv[1])) {
  $events = getGithubEvents($argv[1]);

  if (is_array($events)) {
    usort($events, 'sortCreateEvent');

    $output = ["Output:"];

    foreach ($events as $event) {
      switch ($event['type']) {
        case 'CommitCommentEvent':
          array_push($output, commitCommentEvent($event));
          break;

        case 'CreateEvent':
          array_push($output, createEvent($event));
          break;

        case 'DeleteEvent':
          array_push($output, deleteEvent($event));
          break;

        case 'ForkEvent':
          array_push($output, forkEvent($event));
          break;

        case 'GollumEvent':
          array_push($output, gollumEvent($event));
          break;

        case 'IssueCommentEvent':
          array_push($output, issueCommentEvent($event));
          break;

        case 'IssueEvent':
          array_push($output, issueEvent($event));
          break;

        case 'MemberEvent':
          array_push($output, memberEvent($event));
          break;

        case 'PublicEvent':
          array_push($output, publicEvent($event));
          break;

        case 'PullRequestEvent':
          array_push($output, pullRequestEvent($event));
          break;

        case strpos($event['type'], 'PullRequestReview') !== false:
          array_push($output, pullRequestReviewEvent($event));
          break;

        case 'PushEvent':
          array_push($output, pushEvent($event));
          break;

        case 'ReleaseEvent':
          array_push($output, releaseEvent($event));
          break;

        case 'SponsorshipEvent':
          array_push($output, sponsorshipEvent($event));
          break;

        case 'WatchEvent':
          array_push($output, watchEvent($event));
          break;
      }
    }

    echo implode("\n- ", $output);
    exit;
  }

  echo $events;
}
