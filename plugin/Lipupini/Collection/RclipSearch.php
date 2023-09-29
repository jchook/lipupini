<?php

namespace Plugin\Lipupini\Collection;

use Plugin\Lipupini\Exception;
use System\Lipupini;

class RclipSearch {
	public function __construct(
		public string $collectionFolderName,
		public string $rclipPath,
	) {
		Lipupini::validateCollectionFolderName($collectionFolderName);
		if (!file_exists($this->rclipPath)) {
			throw new Exception('Could not find `rclip`');
		}
		if (!is_executable($this->rclipPath)) {
			throw new Exception('`rclip` bin is not executable');
		}
	}

	public function query(string $query, int $limit = 50) {
		exec($this->rclipCommand($query, '--filepath-only --no-indexing --top=' . $limit), $results, $result_code);
		if ($result_code !== 0) {
			throw new Exception('rclip exited with error result code');
		}
		return $results;
	}

	public function buildIndex() {
		passthru($this->rclipCommand('*'));
	}

	private function getRclipDataDir() {
		return DIR_COLLECTION . '/' . $this->collectionFolderName . '/.lipupini/.rclip';
	}

	private function rclipCommand(string $query, string $flags = ''): string {
		$command = 'cd ' . escapeshellarg(DIR_COLLECTION . '/' . $this->collectionFolderName) . ' &&';
		$command .= ' RCLIP_DATADIR=' . escapeshellarg($this->getRclipDataDir());
		$command .= ' ' . escapeshellcmd($this->rclipPath);
		$command .= ' ' . escapeshellarg($query);
		$command .= ' --exclude-dir=.lipupini';
		if ($flags) {
			$command .= ' ' . $flags;
		}
		return $command;
	}
}
