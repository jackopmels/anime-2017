<?php
// Copyright 2019 Peter Beverloo. All rights reserved.
// Use of this source code is governed by the MIT license, a copy of which can
// be found in the LICENSE file.

declare(strict_types=1);

namespace Anime;

// Main class responsible for composing the collection of event data accessible to a particular
// user. The data returned by this class must conform to the documented API interface:
//
// https://github.com/AnimeNL/portal/blob/master/API.md#apievent
class EventData {
    // The volunteer for whom the data is being compiled.
    private $volunteer;

    // The environments to which this volunteer has access.
    private $environments;

    public function __construct(Environment $environment, Volunteer $volunteer) {
        $this->volunteer = $volunteer;

        if ($this->volunteer->isAdmin())
            $this->environments = Environment::getAll();
        else
            $this->environments = [ $environment ];
    }

    // Returns an array detailing the available volunteer groups.
    public function getVolunteerGroups() : array {
        return [];
    }

    // Returns an array detailing the available volunteers.
    public function getVolunteers() : array {
        return [];
    }
}
