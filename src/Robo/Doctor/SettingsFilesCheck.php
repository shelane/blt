<?php

namespace Acquia\Blt\Robo\Doctor;

/**
 * BLT doctor checks for settings.
 */
class SettingsFilesCheck extends DoctorCheck {

  /**
   * Perform all checks.
   */
  public function performAllChecks() {
    $this->checkDrupalSettingsFile();
    $this->checkLocalSettingsFile();

    return $this->problems;
  }

  /**
   * Check local settings.
   */
  protected function checkLocalSettingsFile() {
    $localSettingsPath = $this->drushStatus['root'] . "/sites/" . $this->getConfigValue('site') . '/settings/local.settings.php';
    if (!file_exists($localSettingsPath)) {
      $this->logProblem('local-settings', [
        'Could not find local settings file.',
        "Your local settings file should exist at $localSettingsPath.",
      ], 'error');
    }
  }

  /**
   * Check Drupal settings.
   */
  protected function checkDrupalSettingsFile() {
    if (!$this->getInspector()->isDrupalSettingsFilePresent()) {
      $this->logProblem('exists', "Could not find settings.php for this site.", 'error');
    }
    else {
      if (!$this->getInspector()->isDrupalSettingsFileValid()) {
        $this->logProblem('drs-settings',
          "DRS settings are not included in settings file.", 'error');
      }
      if (strstr($this->getConfigValue('drupal.settings_file'),
        '/sites/default/settings/blt.settings.php')) {
        $this->logProblem('blt-settings', [
          'Your settings file contains a deprecated statement for including BLT settings.',
          "Please remove the line containing \"/sites/default/settings/blt.settings.php\" in {$this->getConfigValue('drupal.settings_file')}.",
        ], 'error');
      }
    }
  }

}
