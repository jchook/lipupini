<?php

namespace Plugin\Lipupini\Collection\Render;

use Plugin\Lipupini\State;
use System\Lipupini;
use System\Plugin;

class Atom extends Plugin {
	public function start(State $state): State {
		if (empty($state->collectionFolderName)) {
			return $state;
		}

		if (!Lipupini::getClientAccept('AtomXML')) {
			return $state;
		}

		// @TODO: Implement `application/atom+xml` feed for profile

		$state->lipupiniMethod = 'shutdown';
		return $state;
	}
}
