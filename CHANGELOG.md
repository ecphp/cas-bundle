# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [3.0.4](https://github.com/ecphp/cas-bundle/compare/3.0.3...3.0.4)

## [3.0.3](https://github.com/ecphp/cas-bundle/compare/3.0.2...3.0.3) - 2025-01-28

### Merged

- Ajax reqs no redirect on success [`#105`](https://github.com/ecphp/cas-bundle/pull/105)

### Commits

- Fix: No redirect when it's an AJAX request [`e0f36a5`](https://github.com/ecphp/cas-bundle/commit/e0f36a53d07ef7d3d9b7b2991aa1022503639beb)
- chore: bump LICENSE [`6a776b5`](https://github.com/ecphp/cas-bundle/commit/6a776b5f4779cf54cc6508657926ad165c0d6df4)

## [3.0.2](https://github.com/ecphp/cas-bundle/compare/3.0.1...3.0.2) - 2024-10-11

### Merged

- chore: maintenance - compatibility with Symfony 7 - minor fixes [`#100`](https://github.com/ecphp/cas-bundle/pull/100)
- chore(deps): Bump ramsey/composer-install from 2 to 3 [`#99`](https://github.com/ecphp/cas-bundle/pull/99)
- Update composer.json for SF7 [`#98`](https://github.com/ecphp/cas-bundle/pull/98)

### Commits

- chore: update changelog [`852f954`](https://github.com/ecphp/cas-bundle/commit/852f954eddc12df0e34c542e8c3c3bae7b18d677)
- fix, chore: maintenance [`5920cff`](https://github.com/ecphp/cas-bundle/commit/5920cff699d54f72425be219d1c71f3abc3cdee8)
- chore: update license [`dce898f`](https://github.com/ecphp/cas-bundle/commit/dce898faa163ad721a2315146932b7b7143ece4e)
- chore: update default PHP version for development [`67e3ccb`](https://github.com/ecphp/cas-bundle/commit/67e3ccb13a9be021f2e48350758ba88787912f71)
- Update composer.json [`1eb68eb`](https://github.com/ecphp/cas-bundle/commit/1eb68eb2fc32adac5090f174b97fe36ccbd91472)
- Update composer.json [`7e63d26`](https://github.com/ecphp/cas-bundle/commit/7e63d26271f5c80f107d80da0616636117589630)
- Update composer.json [`d30f253`](https://github.com/ecphp/cas-bundle/commit/d30f253e21a442a04b9af9142ff3bf9ae790797e)
- Update composer.json [`ad187cc`](https://github.com/ecphp/cas-bundle/commit/ad187cc5fcb42f1b024ef91475ca1ea96db3ae3b)
- Update composer.json [`8e9f898`](https://github.com/ecphp/cas-bundle/commit/8e9f8981fe115beb47761e2eff762e089179f913)
- chore: add `.readthedocs.yml` config [`ad7747d`](https://github.com/ecphp/cas-bundle/commit/ad7747d68d0d22ec345b114f38b995d698c29dd9)

## [3.0.1](https://github.com/ecphp/cas-bundle/compare/3.0.0...3.0.1) - 2023-11-06

### Commits

- docs: update changelog [`cab9dae`](https://github.com/ecphp/cas-bundle/commit/cab9daea94802e0a09466cb3b62e0075b5a3559b)
- cs: autofix coding standards [`22d2b03`](https://github.com/ecphp/cas-bundle/commit/22d2b03be12d9c5a1bf4910b60cc74d541c9a33b)
- chore: set `min_covered_msi` to `89` [`babf036`](https://github.com/ecphp/cas-bundle/commit/babf036df0f9c390cbfe2fd7ee73ac27ce061068)

## [3.0.0](https://github.com/ecphp/cas-bundle/compare/2.5.5...3.0.0) - 2023-11-06

### Merged

- Update demo casserver URL [`#88`](https://github.com/ecphp/cas-bundle/pull/88)
- Fix link in documentation [`#89`](https://github.com/ecphp/cas-bundle/pull/89)
- chore(deps): Bump cachix/install-nix-action from 22 to 23 [`#91`](https://github.com/ecphp/cas-bundle/pull/91)
- chore(deps): Bump actions/checkout from 3 to 4 [`#90`](https://github.com/ecphp/cas-bundle/pull/90)
- chore(deps): Bump cachix/install-nix-action from 20 to 22 [`#87`](https://github.com/ecphp/cas-bundle/pull/87)
- chore(deps): Bump cachix/install-nix-action from 19 to 20 [`#79`](https://github.com/ecphp/cas-bundle/pull/79)

### Commits

- **Breaking change:** refactor: replace Properties::all() with `Properties::jsonSerialize()`. [`4fbc54b`](https://github.com/ecphp/cas-bundle/commit/4fbc54bd950e0075e57a613ad1a7f293a3be1e1c)
- docs: update changelog [`adc77e6`](https://github.com/ecphp/cas-bundle/commit/adc77e6f42b904a47af3ed87ebe465ad6b51621a)
- ci: bump github actions [`383349c`](https://github.com/ecphp/cas-bundle/commit/383349ca67426a68f68bc3d5a3bd6b109913d95c)
- fix link to Contributing page [`132d60f`](https://github.com/ecphp/cas-bundle/commit/132d60ff22d5dd2e6beee8bb1eaf30b4d4595b93)
- chore: bump versions [`4e11280`](https://github.com/ecphp/cas-bundle/commit/4e11280098962ebed8fec1d9d9d844c6621bd3e5)
- chore: bump versions [`f29ffa8`](https://github.com/ecphp/cas-bundle/commit/f29ffa80eee4553a8e7ea6d6274f32fe44d6afd2)
- chore: remove obsolete docker files [`ee907ae`](https://github.com/ecphp/cas-bundle/commit/ee907aec56e78092f17c5c5e263fb6322467b3c4)
- chore: get rid of scrutinizer [`a50176a`](https://github.com/ecphp/cas-bundle/commit/a50176aaf0846842c2de9bffb677bc8094d08e1c)
- tests: rewrite tests based on upstream `ecphp/cas-lib` developments. [`12fa217`](https://github.com/ecphp/cas-bundle/commit/12fa21760dccf1f7ee7377626ab449ca487a0acc)
- chore: add a note about CAS XML response [`f72e757`](https://github.com/ecphp/cas-bundle/commit/f72e757244dd2c6369ba793139e06a310b47b6cd)
- refactor: update User creation internals [`467d44a`](https://github.com/ecphp/cas-bundle/commit/467d44aee87cc487944a161c6df9c371d57aa820)
- refactor: remove `Symfony*` Cas classes [`13e30e6`](https://github.com/ecphp/cas-bundle/commit/13e30e61ef7f29e0268b3e4722273c9acb208287)
- docs: update `Installation` documentation [`fa17ff4`](https://github.com/ecphp/cas-bundle/commit/fa17ff498a07e79923a34a52cd165f133f0f2eb6)
- tests: fix tests [`1dc9838`](https://github.com/ecphp/cas-bundle/commit/1dc9838f3eb6d6d4a2d0ce63efeb0e7706db628f)
- remove `CasEntryPoint` class [`87109f6`](https://github.com/ecphp/cas-bundle/commit/87109f69144aa07a2be907cc866b5e9f6e38f295)
- fix: update `start` method [`a6ac146`](https://github.com/ecphp/cas-bundle/commit/a6ac146bbbdf9dc89d5ed1c9a6284655fc3d1a3f)
- fix: use the Authenticator as entry point [`4b4d065`](https://github.com/ecphp/cas-bundle/commit/4b4d065506673c12324e718ffe114d7059e117ae)
- docs: Update changelog. [`e6dae46`](https://github.com/ecphp/cas-bundle/commit/e6dae463bac062699b72946fe174e4a726589f15)
- feat: add a CAS Authentication Entry Point [`1cd8abb`](https://github.com/ecphp/cas-bundle/commit/1cd8abb2d4e8000e87a3c6af04cded22db299b22)
- tests: update tests for `ecphp/cas-lib` 2 [`77e96a0`](https://github.com/ecphp/cas-bundle/commit/77e96a0dcc4a4b266d70acf39bb1bc292213bcb3)
- refactor: update codebase for `ecphp/cas-lib` 2 [`4bbff5f`](https://github.com/ecphp/cas-bundle/commit/4bbff5fba7cc3a3dac9d312f78dd463d2c24dd25)
- chore: upgrade to `ecphp/cas-lib` [`94758a7`](https://github.com/ecphp/cas-bundle/commit/94758a7551fe562dc0eddcb65804931613b23eb8)

## [2.5.5](https://github.com/ecphp/cas-bundle/compare/2.5.4...2.5.5) - 2023-03-01

### Merged

- chore(deps): Bump cachix/install-nix-action from 18 to 19 [`#77`](https://github.com/ecphp/cas-bundle/pull/77)

### Commits

- docs: Update changelog. [`7422f89`](https://github.com/ecphp/cas-bundle/commit/7422f89fca32dc990a831be41fa9dbb56bbec57c)
- fix: update `start` method [`e09e56c`](https://github.com/ecphp/cas-bundle/commit/e09e56c724a150e6661ae9de1deddb0dde0f4e82)
- fix: use the Authenticator as entry point [`50d5eee`](https://github.com/ecphp/cas-bundle/commit/50d5eee76fc5fcf56e9e635c8474279d700e5a9f)
- chore: minor static files update [`9b7039a`](https://github.com/ecphp/cas-bundle/commit/9b7039a13037311e27b1fd5dc2663882f26e0430)
- ci: add environment variable for PHP CS Fixer [`ede0450`](https://github.com/ecphp/cas-bundle/commit/ede04504a289bab9c6783e1bcc3e1285b4c79b57)
- docs: update `README` badge [`973f4c9`](https://github.com/ecphp/cas-bundle/commit/973f4c925adf87c46cdb0a37f18053cdabf0876f)
- chore: update `LICENSE` file [`fe745ca`](https://github.com/ecphp/cas-bundle/commit/fe745ca357db4f383e80a691a52c5d3f8dea4054)
- chore: add `pcov` extension requirement in `require-dev` [`4eeb51c`](https://github.com/ecphp/cas-bundle/commit/4eeb51ca5ab71785b42778d62e16f47eb8bfd174)
- tests: fix broken tests [`ceecf54`](https://github.com/ecphp/cas-bundle/commit/ceecf54c4cf0464019f5dc66121980d54b1dcc43)

## [2.5.4](https://github.com/ecphp/cas-bundle/compare/2.5.3...2.5.4) - 2022-12-15

### Commits

- docs: Update changelog. [`099b66b`](https://github.com/ecphp/cas-bundle/commit/099b66bb95c241a21404b00a266410072b57e086)
- fix: restore the use of a `UserProvider` [`b6b5841`](https://github.com/ecphp/cas-bundle/commit/b6b5841ba88331ba9e1c4c0cc7d0968e0c1be1de)

## [2.5.3](https://github.com/ecphp/cas-bundle/compare/2.5.2...2.5.3) - 2022-12-07

### Merged

- chore(deps): Bump cachix/install-nix-action from 17 to 18 [`#72`](https://github.com/ecphp/cas-bundle/pull/72)

### Commits

- docs: Update changelog. [`44fb8d2`](https://github.com/ecphp/cas-bundle/commit/44fb8d2b08790b4b1617f3275522bb5fbe3e4729)
- feat: add `__toString()` method to `CasUserInterface` [`28f74ff`](https://github.com/ecphp/cas-bundle/commit/28f74ff6edf4f32a4d9b69100f41368637372c16)
- nix: remove `-nts` prefix [`068fb1c`](https://github.com/ecphp/cas-bundle/commit/068fb1cab09ea72c743b36581391b879817ac155)

## [2.5.2](https://github.com/ecphp/cas-bundle/compare/2.5.1...2.5.2) - 2022-12-07

### Commits

- docs: Update changelog. [`b3294f8`](https://github.com/ecphp/cas-bundle/commit/b3294f80c07f323df9858b424242255d4f7ef326)
- feat: add `__toString()` method to `CasUserInterface` [`5790eb4`](https://github.com/ecphp/cas-bundle/commit/5790eb4b8572f48d919881eefef7249b4e949fb0)
- nix: remove `-nts` prefix [`bb8be3c`](https://github.com/ecphp/cas-bundle/commit/bb8be3cf580aa055ee778676a06795337ebc96ff)
- docs: Remove Symfony version. [`80f3220`](https://github.com/ecphp/cas-bundle/commit/80f322022193ad0a0f2e3290b98c94d3814bd86b)
- chore: Prettify codebase. [`dce1424`](https://github.com/ecphp/cas-bundle/commit/dce142460a418940e05a8a75e63721ee84a6e11d)
- chore: Normalize `composer.json`. [`0544e74`](https://github.com/ecphp/cas-bundle/commit/0544e7462e5ef9da6f68e948fc5e2d6329c60015)

## [2.5.1](https://github.com/ecphp/cas-bundle/compare/2.5.0...2.5.1) - 2022-08-25

### Commits

- docs: Update changelog. [`3cd5f67`](https://github.com/ecphp/cas-bundle/commit/3cd5f673ebf1631c6178c0c7f069769739d8a576)
- fix: Add missing dependency. [`faca74c`](https://github.com/ecphp/cas-bundle/commit/faca74c08aa2eabdc5aa37868f721b8a0ab4d6da)

## [2.5.0](https://github.com/ecphp/cas-bundle/compare/2.4.5...2.5.0) - 2022-08-25

### Merged

- refactor: Remove deprecated stuff from Symfony 5. [`#71`](https://github.com/ecphp/cas-bundle/pull/71)

### Commits

- docs: Update changelog. [`90756cb`](https://github.com/ecphp/cas-bundle/commit/90756cbce051f0a7b5aa7b42b65487b8a02792f1)

## [2.4.5](https://github.com/ecphp/cas-bundle/compare/2.4.4...2.4.5) - 2023-03-01

### Commits

- docs: Update changelog. [`1e5b00c`](https://github.com/ecphp/cas-bundle/commit/1e5b00c30a5380f4015012e50db57bd7f8760afe)
- fix: update `start` method [`f3ebf70`](https://github.com/ecphp/cas-bundle/commit/f3ebf709c137d77f4087d79d3bae00378eb9d07d)

## [2.4.4](https://github.com/ecphp/cas-bundle/compare/2.4.3...2.4.4) - 2023-02-28

### Commits

- docs: update changelog [`b7c5f89`](https://github.com/ecphp/cas-bundle/commit/b7c5f89c68e37abb0a9a85ffebe83180e27ecf14)
- fix: use the Authenticator as entry point [`d60de33`](https://github.com/ecphp/cas-bundle/commit/d60de336b33d97991ccda3bfd8ab24995b36abd9)

## [2.4.3](https://github.com/ecphp/cas-bundle/compare/2.4.2...2.4.3) - 2023-02-28

### Commits

- docs: Update changelog. [`caac838`](https://github.com/ecphp/cas-bundle/commit/caac83851d4c18d0528db3f4f08f094d0e57866f)
- feat: add a CAS Authentication Entry Point [`173dc52`](https://github.com/ecphp/cas-bundle/commit/173dc520cda646394a830d7053d9f407870759f4)

## [2.4.2](https://github.com/ecphp/cas-bundle/compare/2.4.1...2.4.2) - 2023-02-08

### Commits

- docs: Update changelog. [`7a4bfd4`](https://github.com/ecphp/cas-bundle/commit/7a4bfd40df30e9143411c9b09c3b2da55bb95c4d)
- fix: restore the use of a `UserProvider` [`5531bda`](https://github.com/ecphp/cas-bundle/commit/5531bda793cb4f0891d2c3979883e4a2d3a9253b)
- feat: add `__toString()` method to `CasUserInterface` [`f7cf369`](https://github.com/ecphp/cas-bundle/commit/f7cf369207e3110e10d28407e70a4581548d7089)
- nix: remove `-nts` prefix [`674d2af`](https://github.com/ecphp/cas-bundle/commit/674d2af38bc1fba5400d070c234aaf40edfd629a)
- chore: Normalize `composer.json`. [`b4b7568`](https://github.com/ecphp/cas-bundle/commit/b4b75680d8a4dfd2f7c04599d35d6f677802b8d9)

## [2.4.1](https://github.com/ecphp/cas-bundle/compare/2.4.0...2.4.1) - 2022-08-25

### Commits

- docs: Update changelog. [`748d26b`](https://github.com/ecphp/cas-bundle/commit/748d26b737765cd701ef2eb45b7fc437c314ef87)
- fix: Add missing dependency. [`2d010dc`](https://github.com/ecphp/cas-bundle/commit/2d010dca15314f41c03d26ec0487ed0478f5579f)

## [2.4.0](https://github.com/ecphp/cas-bundle/compare/2.3.2...2.4.0) - 2022-08-25

### Merged

- Version 3 - Work in progress [`#59`](https://github.com/ecphp/cas-bundle/pull/59)

### Commits

- **Breaking change:** refactor: Use new authenticator system. [`9256f95`](https://github.com/ecphp/cas-bundle/commit/9256f95259cfe22431024cd2916f3540738eba76)
- docs: Update changelog. [`01ec7b1`](https://github.com/ecphp/cas-bundle/commit/01ec7b157e18c7c5807295ce9e02bca60e0d6f19)
- chore: Update grumphp configuration. [`fc478a1`](https://github.com/ecphp/cas-bundle/commit/fc478a19178c10f3d75fa1e5b22d4f507cd53070)
- chore: Update composer.json. [`b527382`](https://github.com/ecphp/cas-bundle/commit/b5273822d3cbe5c81e56173cab280f416ee4d9ac)
- fix: Add psalm baseline. [`53ac69a`](https://github.com/ecphp/cas-bundle/commit/53ac69a9a49efe8ea5fe769045f621993759dcea)
- chore: Update grumphp configuration. [`978297d`](https://github.com/ecphp/cas-bundle/commit/978297dc4bb3ea1824625004c3afb570ac79c1a6)
- docs: Add changelog. [`a2fc955`](https://github.com/ecphp/cas-bundle/commit/a2fc95563128b90e4bf17c26d5eca6ad96c7137f)
- ci: Add release workflow. [`aabe67a`](https://github.com/ecphp/cas-bundle/commit/aabe67ad63fa76dff73dc73fb903aaf91e7bca6d)
- chore: Update static files. [`833dc1e`](https://github.com/ecphp/cas-bundle/commit/833dc1e6a5c1d2fdf323495627d942c49056f4ad)
- refactor: Add old authenticator service back. [`e50d1fc`](https://github.com/ecphp/cas-bundle/commit/e50d1fce7097bba3452fb2464c8993b3585e218f)
- refactor: Add extra aliases to CAS services. [`3edc20b`](https://github.com/ecphp/cas-bundle/commit/3edc20b8219d33c60e983b5ccd75d968bcbd9743)
- ci: Update configuration files. [`54e6896`](https://github.com/ecphp/cas-bundle/commit/54e6896742c18978722af7c6d919a2bcf416d193)
- Autofix code style. [`ff4da71`](https://github.com/ecphp/cas-bundle/commit/ff4da71967f98dd039b4609bf87526dab6994879)
- Autofix code style. [`0e4d433`](https://github.com/ecphp/cas-bundle/commit/0e4d433e240bfcd873451e4e594045c83464b39d)
- tests: Update minimum coverage value. [`d74e6b0`](https://github.com/ecphp/cas-bundle/commit/d74e6b0c9a6aaee8d5da4266a2345bd51573d890)
- tests: Update PSalm configuration. [`bd6808d`](https://github.com/ecphp/cas-bundle/commit/bd6808dbd05023986383e944b46b3f57291bd1a9)
- tests: Remove unsupported tests of PHPSpec. [`607ff89`](https://github.com/ecphp/cas-bundle/commit/607ff89fbcdaa9464a61f499b37a3f4b3a5f481a)
- ci: Update configuration files. [`16b0c24`](https://github.com/ecphp/cas-bundle/commit/16b0c24dbe65c4902c98a32de21d29185bd0d9f3)
- chore: Update static files, version and add `.envrc`. [`1c1add4`](https://github.com/ecphp/cas-bundle/commit/1c1add494bc99cf5608a4e2a8e6a1f8191d3d7f1)

## [2.3.2](https://github.com/ecphp/cas-bundle/compare/2.3.1...2.3.2) - 2022-04-14

### Merged

- Suppress the PHP 8+ deprecation message that pops when APP_DEBUG=true [`#62`](https://github.com/ecphp/cas-bundle/pull/62)
- Update phpspec/phpspec requirement from 7.0.1 to 7.2.0 [`#60`](https://github.com/ecphp/cas-bundle/pull/60)
- Bump actions/cache from 2.1.7 to 3 [`#61`](https://github.com/ecphp/cas-bundle/pull/61)
- Bump actions/cache from 2.1.6 to 2.1.7 [`#57`](https://github.com/ecphp/cas-bundle/pull/57)

### Commits

- chore: Update licence holder. [`63fd144`](https://github.com/ecphp/cas-bundle/commit/63fd144006d5d3f31d8f0492911d749566560fb9)
- chore: Normalize `composer.json`. [`9e435dd`](https://github.com/ecphp/cas-bundle/commit/9e435dd9893e6b27421caeed0fbc5dfa33066192)

## [2.3.1](https://github.com/ecphp/cas-bundle/compare/2.3.0...2.3.1) - 2021-11-12

### Commits

- fix: Add `CasUser::getUserIdentifier()`. [`e19fdb3`](https://github.com/ecphp/cas-bundle/commit/e19fdb3c34062528c55c0b4e576c123728d0aa09)

## [2.3.0](https://github.com/ecphp/cas-bundle/compare/2.2.2...2.3.0) - 2021-07-29

### Merged

- Bump actions/cache from 2.1.5 to 2.1.6 [`#50`](https://github.com/ecphp/cas-bundle/pull/50)
- Update infection/infection requirement from ^0.23 to ^0.24 [`#53`](https://github.com/ecphp/cas-bundle/pull/53)
- Update loophp/unaltered-psr-http-message-bridge-bundle requirement from ^1.0 to ^2.0 [`#52`](https://github.com/ecphp/cas-bundle/pull/52)
- Bump actions/cache from 2.1.4 to 2.1.5 [`#48`](https://github.com/ecphp/cas-bundle/pull/48)
- Update infection/infection requirement from ^0.22 to ^0.23 [`#49`](https://github.com/ecphp/cas-bundle/pull/49)
- Update friends-of-phpspec/phpspec-code-coverage requirement from ^5.0.0 to ^6.0.0 [`#44`](https://github.com/ecphp/cas-bundle/pull/44)
- Bump actions/cache from v2 to v2.1.4 [`#41`](https://github.com/ecphp/cas-bundle/pull/41)
- Update vimeo/psalm requirement from ^3.14.1 to ^4.2.0 [`#37`](https://github.com/ecphp/cas-bundle/pull/37)
- Update friends-of-phpspec/phpspec-code-coverage requirement from ^4.3.2 to ^5.0.0 [`#36`](https://github.com/ecphp/cas-bundle/pull/36)

### Commits

- Update loophp/unaltered-psr-http-message-bridge-bundle requirement [`9e7553d`](https://github.com/ecphp/cas-bundle/commit/9e7553d40a4dc255f17f334ea93eb3aac8820a21)
- Revert "ci: Disable builds on macOS until phpspec/phpspec#1380 is fixed." [`d0bcd72`](https://github.com/ecphp/cas-bundle/commit/d0bcd7262cf654a26909dcd142c7e2362907d391)
- ci: Disable builds on macOS until phpspec/phpspec#1380 is fixed. [`b3f5011`](https://github.com/ecphp/cas-bundle/commit/b3f5011cabb02ec97167917a0630366dcfcc0e2a)
- Autofix code style. [`1ce1219`](https://github.com/ecphp/cas-bundle/commit/1ce1219e43633acd63c7a62fb08075d1ca624bc6)
- chore: Update .gitattributes. [`6b549fd`](https://github.com/ecphp/cas-bundle/commit/6b549fde6d3fba10a17358d3f6edf54a26fe6e29)
- Autofix code style. [`9a02ee8`](https://github.com/ecphp/cas-bundle/commit/9a02ee819fb51beb7644edec1bd6ef1d3ca4ea8d)
- Do not upgrade phpspec until phpspec/phpspec#1382 is fixed. [`36de9bc`](https://github.com/ecphp/cas-bundle/commit/36de9bc7e5497a71cc01e0161f8956ab0e280f4b)
- chore: Update composer.json. [`569de28`](https://github.com/ecphp/cas-bundle/commit/569de2827e129ab841a2c0e787d65d92de81b4d2)
- refactor: Autofix code style. [`d245d4e`](https://github.com/ecphp/cas-bundle/commit/d245d4ee8460a1a4cc9e72e96bb0350c2f0d1681)
- chore: Switch to ecphp/php-conventions. [`ce3df60`](https://github.com/ecphp/cas-bundle/commit/ce3df6067ed4332731da8ca439888e9279dc9e2c)
- refactor: Add missing services declarations. [`8baead7`](https://github.com/ecphp/cas-bundle/commit/8baead76dc9c355359a089fc544e18f8edc854ae)
- refactor: Implements EquatableInterface on CasUserInterface. [`a525263`](https://github.com/ecphp/cas-bundle/commit/a525263f9afb8215c9d04a645c51b917f043a3ca)
- Update friends-of-phpspec/phpspec-code-coverage requirement [`ddadbe3`](https://github.com/ecphp/cas-bundle/commit/ddadbe3cb361db49ba291ad1b8744eec6e096a97)
- test: Fix CS. [`53a846b`](https://github.com/ecphp/cas-bundle/commit/53a846b8964e605013aabb6b2efca3001fa39626)
- tests: Remove unused mocked parameters. [`bf1b68e`](https://github.com/ecphp/cas-bundle/commit/bf1b68e4debd1d38996c050682c313e38264db1a)
- tests: Remove now obsolete test. [`5c635f9`](https://github.com/ecphp/cas-bundle/commit/5c635f925e4d2274023c661df74217fb2d8143b9)
- ci: Update Github configuration. [`2c4349f`](https://github.com/ecphp/cas-bundle/commit/2c4349fc98aa7ebd261a4e2afb929de6237f5861)
- refactor: Remove deprecations for next major release. [`92ebeec`](https://github.com/ecphp/cas-bundle/commit/92ebeec92c3c47cce183f9f29eb6fa02e4063702)
- refactor: Remove hard dependency to nyholm/psr7 and sension/framework-extra-bundle. [`2204a7f`](https://github.com/ecphp/cas-bundle/commit/2204a7f40b350b4677f078ad733d453a540d7fdf)
- chore: Removed hard dependencies from requirements. [`34d2f0e`](https://github.com/ecphp/cas-bundle/commit/34d2f0e35ff22c5fd1072cc1beb99b959ef7cd12)
- Update friends-of-phpspec/phpspec-code-coverage requirement [`8c7a687`](https://github.com/ecphp/cas-bundle/commit/8c7a6877653d9ca27f4961bd7736e2818fcfd49c)

## [2.2.2](https://github.com/ecphp/cas-bundle/compare/2.2.1...2.2.2) - 2020-08-25

### Commits

- Bump dev dependencies. [`b076eee`](https://github.com/ecphp/cas-bundle/commit/b076eeebf7ccecc3f7820ec83ab1f9f2324df264)
- Add sension/framework-extra-bundle:^5.6 as a dependency. [`d6bc641`](https://github.com/ecphp/cas-bundle/commit/d6bc641aa1839a3930ae92fe0124c0c084c1e923)

## [2.2.1](https://github.com/ecphp/cas-bundle/compare/2.2.0...2.2.1) - 2020-07-27

### Commits

- Remove obsolete PHPDoc to not mess with ecphp/eu-login-bundle when doing static analysis. [`62edc9e`](https://github.com/ecphp/cas-bundle/commit/62edc9e724a6cac9a867171fa70f25e7e5f0be67)
- Add Psalm, Infection and Insights reports. [`c80290b`](https://github.com/ecphp/cas-bundle/commit/c80290b73081295885b049a1750e3205ecbf4baa)

## [2.2.0](https://github.com/ecphp/cas-bundle/compare/2.1.2...2.2.0) - 2020-07-23

### Merged

- Add the new dependency to the CAS service and CAS User provider. [`#15`](https://github.com/ecphp/cas-bundle/pull/15)

### Commits

- Update CS. [`f330531`](https://github.com/ecphp/cas-bundle/commit/f3305314e4267a686e0a5a3bfa2fe684bf468dad)
- Update composer.json. [`fb0890e`](https://github.com/ecphp/cas-bundle/commit/fb0890e6e9cfb08a14860e900046bf8a8727cdae)
- Update tests. [`b375d5c`](https://github.com/ecphp/cas-bundle/commit/b375d5c8fda4ef3bae587df3b2e9d1226616578c)

## [2.1.2](https://github.com/ecphp/cas-bundle/compare/2.1.1...2.1.2) - 2020-07-23

### Merged

- Improve coverage [`#14`](https://github.com/ecphp/cas-bundle/pull/14)

### Commits

- Fix CS. [`e9792b1`](https://github.com/ecphp/cas-bundle/commit/e9792b13b11a5f41f2853fde067c6e345ffc7a5d)
- Update Grumphp configuration. [`013e266`](https://github.com/ecphp/cas-bundle/commit/013e26693f637830b4b21e78d00324dfdbd33830)
- Update composer.json. [`885c3f2`](https://github.com/ecphp/cas-bundle/commit/885c3f29ebeb073e325c564bc9c5fab958bc7cd2)
- Deprecate CasUserInterface::getUser(). [`9fd3bc3`](https://github.com/ecphp/cas-bundle/commit/9fd3bc3ae50ee1c8525b59c5eb44a3626d280924)

## [2.1.1](https://github.com/ecphp/cas-bundle/compare/2.1.0...2.1.1) - 2020-07-07

### Commits

- Revert "Replace user routing file cas.yaml with cas.php." [`c28377b`](https://github.com/ecphp/cas-bundle/commit/c28377bffed12d5c998f7d565c727af856fddf90)

## [2.1.0](https://github.com/ecphp/cas-bundle/compare/2.0.9...2.1.0) - 2020-06-29

### Commits

- Replace XML routing file with bare PHP. [`be0ab05`](https://github.com/ecphp/cas-bundle/commit/be0ab0510d34246888cce11e5cdd8fb15f8bcc32)
- Symfony recipe is live, update installation steps. [`750e8e3`](https://github.com/ecphp/cas-bundle/commit/750e8e33544f915b24044358ba4cbec42fd0ee62)
- Replace user routing file cas.yaml with cas.php. [`5321218`](https://github.com/ecphp/cas-bundle/commit/5321218d711c01126c1410cbec70665b86ceedba)
- Update composer.json. [`cf400cd`](https://github.com/ecphp/cas-bundle/commit/cf400cd1cf5a6029b03a05fdab005984711e6ebe)
- Replace deprecated function. [`8107883`](https://github.com/ecphp/cas-bundle/commit/81078836f5f1543d0c4c305f85d311230eacef3d)
- Update composer.json for Symfony ^5.1. [`6d89920`](https://github.com/ecphp/cas-bundle/commit/6d8992090234ede7821600530468a8e17b1ab56d)
- Replace YAML file with a PHP file. [`e4ed834`](https://github.com/ecphp/cas-bundle/commit/e4ed834280ba07b90a61dac32c94bbd49f8213ef)
- Remove a test in which it is unable to mock objects properly. [`60c86cb`](https://github.com/ecphp/cas-bundle/commit/60c86cb2580d8aa338cf6826cb147d58282981c3)

## [2.0.9](https://github.com/ecphp/cas-bundle/compare/2.0.8...2.0.9) - 2020-06-21

### Merged

- Set  object before calling ticket validation [`#12`](https://github.com/ecphp/cas-bundle/pull/12)

## [2.0.8](https://github.com/ecphp/cas-bundle/compare/2.0.7...2.0.8) - 2020-06-17

### Commits

- Load controllers from services. [`39e0867`](https://github.com/ecphp/cas-bundle/commit/39e0867d6b209be1f780b512c6cefb98e685076a)

## [2.0.7](https://github.com/ecphp/cas-bundle/compare/2.0.6...2.0.7) - 2020-06-17

### Commits

- Load the services from the package, not from the final application. [`8a65faa`](https://github.com/ecphp/cas-bundle/commit/8a65faae3120ee7a737e200643cdf27c80e17256)

## [2.0.6](https://github.com/ecphp/cas-bundle/compare/2.0.5...2.0.6) - 2020-06-16

### Commits

- Add missing sensiolabs/SensioFrameworkBundle interfaces alias. [`4f3d864`](https://github.com/ecphp/cas-bundle/commit/4f3d864cdf56fee2ba9f8e7c49b77cd7a2dabb43)

## [2.0.5](https://github.com/ecphp/cas-bundle/compare/2.0.4...2.0.5) - 2020-06-12

### Commits

- Update configuration file. [`2fb76e1`](https://github.com/ecphp/cas-bundle/commit/2fb76e1f54096e67d6f53dd5196a06f64a87a1d1)

## [2.0.4](https://github.com/ecphp/cas-bundle/compare/2.0.3...2.0.4) - 2020-06-11

### Merged

- Bump actions/cache from v1 to v2 [`#10`](https://github.com/ecphp/cas-bundle/pull/10)
- Update symfony/psr-http-message-bridge requirement from ^1.2 to ^2.0 [`#11`](https://github.com/ecphp/cas-bundle/pull/11)

### Commits

- Update documentation. [`3978c2d`](https://github.com/ecphp/cas-bundle/commit/3978c2d7e3941e9eacc841240505e4c16af1d481)
- Update composer.json. [`4fe39bc`](https://github.com/ecphp/cas-bundle/commit/4fe39bc91401d77b9fcb01f7fbb0bf6ea2bf8632)
- Update the cas_services.yaml file and let user customize the PSR request through a middleware package. [`a40ab51`](https://github.com/ecphp/cas-bundle/commit/a40ab51d6651232baa47dcd4d579328023c9d860)
- Update Dockerfile to make Docker happy again. [`9ca1c76`](https://github.com/ecphp/cas-bundle/commit/9ca1c769dda0228a2a9e7c1f2b848bf909bd6ce0)
- Add Dependabot configuration. [`8ddcc07`](https://github.com/ecphp/cas-bundle/commit/8ddcc07ede550af280d486cd4d7f469fd6b857e3)
- Update Controllers, it is not necessary to extend AbstractController anymore. [`cf294d6`](https://github.com/ecphp/cas-bundle/commit/cf294d65ba04b518c0179e11aff60f8ce6b01114)
- Update routing file. [`bca8c68`](https://github.com/ecphp/cas-bundle/commit/bca8c688b32318d46714fea7a08eabff0c7fdcd3)
- Update composer.json, replace dependency to symfony/framework-bundle with symfony/routing. [`1b9a4a1`](https://github.com/ecphp/cas-bundle/commit/1b9a4a1cf1b35393962d9b2c29bf593f9cf8af7e)
- Fix PHPStan issues. [`c25b22d`](https://github.com/ecphp/cas-bundle/commit/c25b22dca69fcb4cae226d39801b269a16f0bbab)

## [2.0.3](https://github.com/ecphp/cas-bundle/compare/2.0.2...2.0.3) - 2020-05-07

### Commits

- Bump drupol/php-conventions. [`ef92e50`](https://github.com/ecphp/cas-bundle/commit/ef92e508e560d10dc2885e860c8f596ab85334f5)

## [2.0.2](https://github.com/ecphp/cas-bundle/compare/2.0.1...2.0.2) - 2020-04-29

### Commits

- Documentation upgrade [`7ee5d5d`](https://github.com/ecphp/cas-bundle/commit/7ee5d5db0499239ffa8c76c4d933ba0647a324ad)

## [2.0.1](https://github.com/ecphp/cas-bundle/compare/2.0.0...2.0.1) - 2020-02-10

### Merged

- #1: Detect when the request is AJAX and respond using a JSON response. [`#2`](https://github.com/ecphp/cas-bundle/pull/2)

## [2.0.0](https://github.com/ecphp/cas-bundle/compare/1.1.2...2.0.0) - 2020-01-31

### Commits

- Migrate project to new organisation. [`4fd6825`](https://github.com/ecphp/cas-bundle/commit/4fd68252a119f0ce477c9c45a07dbf810701ec3c)
- Add a custom service to not depend on sensio/framework-extra-bundle any longer. [`005f093`](https://github.com/ecphp/cas-bundle/commit/005f0936ff3e97e795d03101ca097d4e54ef6ffc)
- Update Github Actions configuration. [`0dfad60`](https://github.com/ecphp/cas-bundle/commit/0dfad60a4b0b3ffa062f50b351bbc9162bc970cc)
- Update composer.json. [`3eddfc6`](https://github.com/ecphp/cas-bundle/commit/3eddfc6e42878aa793b12faa021c3cb7c39659ca)
- Update documentation. [`b44ff40`](https://github.com/ecphp/cas-bundle/commit/b44ff4025a88f309a587d83fb9b76097ffe79cd5)
- Bump minimal contrib version. [`2bfa235`](https://github.com/ecphp/cas-bundle/commit/2bfa2352853e3610598695a5a9f7185ff597c518)
- Update PHPSpec configuration. [`0cf25a2`](https://github.com/ecphp/cas-bundle/commit/0cf25a2d34fa5da2bbf05f7f52fa3d085945344d)
- Bump contrib. [`fb596a1`](https://github.com/ecphp/cas-bundle/commit/fb596a1fdcfe7f40f82f887652d3732a7b9da41c)
- Add authenticators in the default guard. [`1c35aa1`](https://github.com/ecphp/cas-bundle/commit/1c35aa178e2a0224f6433d18d5173c483b8df0fc)
- Revert "Set the CAS service as public." [`4c651cb`](https://github.com/ecphp/cas-bundle/commit/4c651cb057d6d954abf087811bbaa4794104201e)
- Set the CAS service as public. [`6ad7cfc`](https://github.com/ecphp/cas-bundle/commit/6ad7cfc07760c79bb952b1f7593eafd730f316f2)
- Remove PHP 7.4. [`5ae3494`](https://github.com/ecphp/cas-bundle/commit/5ae34948023d99f5e3205b63ae61cef28bd3f6cb)
- Remove PHP 7.1, add PHP 7.4. [`e65455a`](https://github.com/ecphp/cas-bundle/commit/e65455a594a29dce30849bdbe02e3e1c46e0e87c)
- Update PHPDoc. [`91cd3f8`](https://github.com/ecphp/cas-bundle/commit/91cd3f8b7dbb18fb9eb423f57a3290a7446e0a36)
- Remove obsolete TokenStorage. [`b31aa51`](https://github.com/ecphp/cas-bundle/commit/b31aa5124846ca82545f4b73aad4197f477a2941)
- Fix PHPDoc and restore infection/infection contrib. [`d73038f`](https://github.com/ecphp/cas-bundle/commit/d73038f4cab0cb897bda0fdbbbe17c6a9b53c3b5)
- Remove the renew parameter if it is found in the URL. [`f69e42b`](https://github.com/ecphp/cas-bundle/commit/f69e42bef8c0b7e38a497d709a5337d96c9b9bd9)
- Implement an alternative solution when user authentication has failed. [`381e56a`](https://github.com/ecphp/cas-bundle/commit/381e56a497204aab2e297ecce6ae13141089354f)
- Add status to the JSON response in case of failure. [`518098e`](https://github.com/ecphp/cas-bundle/commit/518098e72c63fedc2eeeb5f56ca9dd169362cc9b)
- Sync from branch 4.4. [`0a81041`](https://github.com/ecphp/cas-bundle/commit/0a810417939a5fd32eba022efd0095f5bd06d507)
- Update documentation. [`cf1d0ef`](https://github.com/ecphp/cas-bundle/commit/cf1d0ef538e3add9896408065a1bf258d786ec5c)
- Update Login controller. [`fb426cd`](https://github.com/ecphp/cas-bundle/commit/fb426cd50d76513bbe031bb268004835ece6b9d9)
- Restore package that are now compatible. [`e0609b2`](https://github.com/ecphp/cas-bundle/commit/e0609b2894620357f97d50c224403a6c873415cb)
- Remove obsolete code. [`bfcf541`](https://github.com/ecphp/cas-bundle/commit/bfcf54126c0e21d2321bd51102416c8514eb38c8)
- Update composer.json. [`e0e7529`](https://github.com/ecphp/cas-bundle/commit/e0e75297d1a96b7a7d68fcd4d88b2828d2c9e461)
- Update composer.json and documentation. [`f06a702`](https://github.com/ecphp/cas-bundle/commit/f06a7028a445829f95508f7d2ac1fe055c839fb8)
- CasUser::getSalt() cannot throw an exception or else the login process fails. [`2b66ace`](https://github.com/ecphp/cas-bundle/commit/2b66ace8450c669594bb1e7ddbb204fb3c540694)
- CasUser::getPassword() cannot throw an exception or else the login process fails. [`153a01a`](https://github.com/ecphp/cas-bundle/commit/153a01aafbb450176ebe8b20e6cfeac2c9c39af3)
- CasUser::eraseCredentials() cannot throw an exception or else the login process fails. [`7bc3e7d`](https://github.com/ecphp/cas-bundle/commit/7bc3e7d5e2e7e270fca7c2c017b74b4c26fb4bc3)
- Use stable branch of phpspec now that it has been released. [`9a78d5a`](https://github.com/ecphp/cas-bundle/commit/9a78d5a6017dc9eee75eca4b86036c0d37efe2b6)
- Sync from branch 4.4 [`4622666`](https://github.com/ecphp/cas-bundle/commit/462266673500acd62a30647b760da56ca7778842)
- Update Travis configuration. [`24d563a`](https://github.com/ecphp/cas-bundle/commit/24d563a6e558cd6d1b5d3a5da6de3079d72609cd)
- Update Travis configuration. [`cbda424`](https://github.com/ecphp/cas-bundle/commit/cbda4245a23c4a7e7c8e92e6d4434a96349723c9)
- Sync tests from branch 4.4 [`d9da252`](https://github.com/ecphp/cas-bundle/commit/d9da2527d8f74a93ce231297b7735a42875434ab)
- Update composer contrib while tools are not yet stable. [`cc44b05`](https://github.com/ecphp/cas-bundle/commit/cc44b05822dc2217893868fc51bfbf2a2743ece5)
- Allow failure for PHP 7.4 until stable. [`e939ddf`](https://github.com/ecphp/cas-bundle/commit/e939ddfcc7797b1f028950a908ad35c9b5ef1e31)
- Try to use PHP 7.4 snapshot. [`80ae3a3`](https://github.com/ecphp/cas-bundle/commit/80ae3a35e04e092227202fb77310e0521a7ba3c6)
- Remove PHP 7.1. [`7278e44`](https://github.com/ecphp/cas-bundle/commit/7278e44223b4f41644a1b6163874bbd019ef37a7)
- Update Travis for the time being. [`bcb94a5`](https://github.com/ecphp/cas-bundle/commit/bcb94a543594636bc5cb4fe124687f7be1f3ae37)
- Enable tests and sync from branch 4.4 [`89a6591`](https://github.com/ecphp/cas-bundle/commit/89a659105b7d0dbe519ffd8c0f6418828b9e5df3)
- Update CasUser based on 4.4 branch. [`fae118d`](https://github.com/ecphp/cas-bundle/commit/fae118d34d5ddc0b308a9d7e47d3799d8466778f)

## [1.1.2](https://github.com/ecphp/cas-bundle/compare/1.1.1...1.1.2) - 2020-08-25

### Commits

- Bump dev dependencies. [`ab87ac5`](https://github.com/ecphp/cas-bundle/commit/ab87ac503568a7e4c9113e7de4d75b6b20d86f8a)
- Add sension/framework-extra-bundle:^5.6 as a dependency. [`0f69f1d`](https://github.com/ecphp/cas-bundle/commit/0f69f1d9c043bbab039db6e2734405a5e4acdaa5)

## [1.1.1](https://github.com/ecphp/cas-bundle/compare/1.1.0...1.1.1) - 2020-07-27

### Commits

- Remove obsolete PHPDoc to not mess with ecphp/eu-login-bundle when doing static analysis. [`6a3ee9a`](https://github.com/ecphp/cas-bundle/commit/6a3ee9aa10b0a3f5a0e02b5e55138cf73b14c144)
- Add Psalm, Infection and Insights reports. [`c444b9a`](https://github.com/ecphp/cas-bundle/commit/c444b9adf33d28447ce366e1aadd99e0257bdf51)

## [1.1.0](https://github.com/ecphp/cas-bundle/compare/1.0.14...1.1.0) - 2020-07-23

### Commits

- Update CS. [`07d6817`](https://github.com/ecphp/cas-bundle/commit/07d68179c5211a12fd945477c11dc041cc7cb672)
- Update composer.json. [`fabaff5`](https://github.com/ecphp/cas-bundle/commit/fabaff5097f44f67ec8c994f53bd6f5aef98e946)
- Update tests. [`bcec5bd`](https://github.com/ecphp/cas-bundle/commit/bcec5bdd4ff2c863b65167b16188ab586a7730c2)
- Add the new dependency to the CAS service and CAS User provider. [`b6bbddd`](https://github.com/ecphp/cas-bundle/commit/b6bbddd758eb9a39488648c2c367e0bdf6155ad9)

## [1.0.14](https://github.com/ecphp/cas-bundle/compare/1.0.13...1.0.14) - 2020-07-23

### Commits

- Fix CS. [`2fe5654`](https://github.com/ecphp/cas-bundle/commit/2fe5654822c5a9a9835f86d2b26955392853291c)
- Update Grumphp configuration. [`b3d8d86`](https://github.com/ecphp/cas-bundle/commit/b3d8d864b4aec3cd3025d11afa1ebb3f583374d8)
- Update composer.json. [`fdd6982`](https://github.com/ecphp/cas-bundle/commit/fdd6982f9f741631b37feba78ae855b93b6fbb4b)
- Deprecate CasUserInterface::getUser(). [`f559ded`](https://github.com/ecphp/cas-bundle/commit/f559ded79c04fae1e5b4f029f82080a3735db684)
- Improve coverage (#14) [`8903595`](https://github.com/ecphp/cas-bundle/commit/890359548a37c9bcd16a825f7db86ee7412ea35e)

## [1.0.13](https://github.com/ecphp/cas-bundle/compare/1.0.12...1.0.13) - 2020-07-07

### Commits

- Revert "Replace user routing file cas.yaml with cas.php." [`e682a43`](https://github.com/ecphp/cas-bundle/commit/e682a43b119beb5dbf2ecd06a3140d6d3d6ecb4f)

## [1.0.12](https://github.com/ecphp/cas-bundle/compare/1.0.11...1.0.12) - 2020-06-28

### Commits

- Symfony recipe is live, update installation steps. [`7bc273e`](https://github.com/ecphp/cas-bundle/commit/7bc273e6be2cc72eaeb5f4eb05ded4d525c3e5e0)
- Replace user routing file cas.yaml with cas.php. [`dcb331f`](https://github.com/ecphp/cas-bundle/commit/dcb331fd22a7097e450e56cc8334816b32e0c212)
- Replace YAML file with a PHP file. [`3693960`](https://github.com/ecphp/cas-bundle/commit/3693960fa2ce35aa6278ab7ac6cde3f4329b24d5)
- Remove a test in which it is unable to mock objects properly. [`22fb335`](https://github.com/ecphp/cas-bundle/commit/22fb335d1a2fbc4941977f38c27acd9fd141b8c4)

## [1.0.11](https://github.com/ecphp/cas-bundle/compare/1.0.10...1.0.11) - 2020-06-21

### Merged

- Set  object before calling ticket validation [`#12`](https://github.com/ecphp/cas-bundle/pull/12)

## [1.0.10](https://github.com/ecphp/cas-bundle/compare/1.0.9...1.0.10) - 2020-06-17

### Commits

- Load controllers from services. [`3dfe8b9`](https://github.com/ecphp/cas-bundle/commit/3dfe8b9f489a15544229261896a7d4030e85c75a)

## [1.0.9](https://github.com/ecphp/cas-bundle/compare/1.0.8...1.0.9) - 2020-06-17

### Commits

- Load the services from the package, not from the final application. [`2a0d7fc`](https://github.com/ecphp/cas-bundle/commit/2a0d7fc1f150d5dcfa31e1bba7885b1782e8fb93)

## [1.0.8](https://github.com/ecphp/cas-bundle/compare/1.0.7...1.0.8) - 2020-06-16

### Commits

- Add missing sensiolabs/SensioFrameworkBundle interfaces alias. [`56bcde4`](https://github.com/ecphp/cas-bundle/commit/56bcde4b09140535b7607f4106b8dab2ab6d54bc)

## [1.0.7](https://github.com/ecphp/cas-bundle/compare/1.0.6...1.0.7) - 2020-06-12

### Commits

- Update cas_services.yaml. [`cca8f63`](https://github.com/ecphp/cas-bundle/commit/cca8f6396f41789c4b0ea26b8b2d9a9e3684d462)

## [1.0.6](https://github.com/ecphp/cas-bundle/compare/1.0.5...1.0.6) - 2020-06-12

### Commits

- Update composer.json. [`214b560`](https://github.com/ecphp/cas-bundle/commit/214b560cbe2a0081833b271a0195be6a985fec7b)

## [1.0.5](https://github.com/ecphp/cas-bundle/compare/1.0.4...1.0.5) - 2020-06-12

### Commits

- Update configuration file. [`6235fd9`](https://github.com/ecphp/cas-bundle/commit/6235fd997716014843d5704e9bc0fc77ac7abdb5)

## [1.0.4](https://github.com/ecphp/cas-bundle/compare/1.0.3...1.0.4) - 2020-06-11

### Commits

- Update Controllers, it is not necessary to extend AbstractController anymore. [`393954b`](https://github.com/ecphp/cas-bundle/commit/393954b9ec2bb1fb426aaecc02c5520c96bcf7df)
- Update documentation. [`18b7eaf`](https://github.com/ecphp/cas-bundle/commit/18b7eafe691b478fa766a34eedd651997cfaeb0d)
- Update composer.json. [`804355d`](https://github.com/ecphp/cas-bundle/commit/804355ddc3d4d534f49fd28a2cd1e8ea107d913f)
- Update the cas_services.yaml file and let user customize the PSR request through a middleware package. [`cdf85d5`](https://github.com/ecphp/cas-bundle/commit/cdf85d5169456694f2bc5ab762e47b534ab20175)
- Update Dockerfile to make Docker happy again. [`b4e238f`](https://github.com/ecphp/cas-bundle/commit/b4e238f9d5918a4cd2f7193dd3761cfb3222490d)
- Add Dependabot configuration. [`a444973`](https://github.com/ecphp/cas-bundle/commit/a444973845a54fbbfe46b3731889e7e9fc980acc)

## [1.0.3](https://github.com/ecphp/cas-bundle/compare/1.0.2...1.0.3) - 2020-05-07

### Commits

- Bump drupol/php-conventions. [`d9eaa35`](https://github.com/ecphp/cas-bundle/commit/d9eaa35d2868e17c0dbb47ec7e4be37b3f9226c5)

## [1.0.2](https://github.com/ecphp/cas-bundle/compare/1.0.1...1.0.2) - 2020-04-29

### Commits

- Documentation upgrade [`ec3f9fa`](https://github.com/ecphp/cas-bundle/commit/ec3f9fa5163cf1af788cef5a45b4ad22d6c7705a)

## [1.0.1](https://github.com/ecphp/cas-bundle/compare/1.0.0...1.0.1) - 2020-02-10

### Commits

- #1: Detect when the request is AJAX and respond using a JSON response. [`1da4bba`](https://github.com/ecphp/cas-bundle/commit/1da4bba99b62e7693b0a99fb7b7d52decca45326)

## 1.0.0 - 2020-01-31

### Merged

- Update cas_services.yaml [`#1`](https://github.com/ecphp/cas-bundle/pull/1)

### Commits

- Migrate project to new organisation. [`d003327`](https://github.com/ecphp/cas-bundle/commit/d0033273522ee0dbca51ddb49959184556b8584d)
- Add a custom service to not depend on sensio/framework-extra-bundle any longer. [`4fe5565`](https://github.com/ecphp/cas-bundle/commit/4fe55654534cd5b82ad5aac3f58285fe24dde126)
- Update composer.json. [`cd2035a`](https://github.com/ecphp/cas-bundle/commit/cd2035a2c2726eb668d146df9b76b05d423e0b38)
- Update composer.json. [`7cef5cf`](https://github.com/ecphp/cas-bundle/commit/7cef5cfbf7e9e352d7e7dfc41a87322069a13895)
- Remove Travis, use Github actions. [`afd1f11`](https://github.com/ecphp/cas-bundle/commit/afd1f1138dd208321876dd710a764dd948baa027)
- Update documentation. [`00635b1`](https://github.com/ecphp/cas-bundle/commit/00635b1ec8b5b501e3f55db1858685d94e0a5a6d)
- Update composer.json. [`231e8f9`](https://github.com/ecphp/cas-bundle/commit/231e8f9274f496ae7d6a1d6eebfda7d7c90e60ae)
- Bump minimal contrib version. [`1dcc823`](https://github.com/ecphp/cas-bundle/commit/1dcc823d067f03f69cef5879d6b41e68de7b46c3)
- Update PHPSpec configuration. [`20887db`](https://github.com/ecphp/cas-bundle/commit/20887dbd5575ca207b9616a7cf53827a90f14ab7)
- Sync from master branch. [`b453797`](https://github.com/ecphp/cas-bundle/commit/b453797cf9e5629a182474c7b1676e87995abdd3)
- Add authenticators in the default guard. [`5e49c82`](https://github.com/ecphp/cas-bundle/commit/5e49c826c58a4f1592eed147686250b0438fe02f)
- Remove PHP 7.4. [`462fef6`](https://github.com/ecphp/cas-bundle/commit/462fef66fbc2d416af96dbbea69cfc071f07122c)
- Remove PHP 7.1, add PHP 7.4. [`1a10f77`](https://github.com/ecphp/cas-bundle/commit/1a10f77848d0325c774499a07546b15a830ff711)
- Update PHPDoc. [`6eac960`](https://github.com/ecphp/cas-bundle/commit/6eac960b8e991006528f89d8e7463dd2b089694d)
- Bump version. [`5cd7c13`](https://github.com/ecphp/cas-bundle/commit/5cd7c1385c09c2493fe25141e7712a154e609076)
- Update actions. [`4fe51ef`](https://github.com/ecphp/cas-bundle/commit/4fe51ef8e924b7dc959eff09cd6b52b8f158af6f)
- Fix PHPStan. [`7708f5c`](https://github.com/ecphp/cas-bundle/commit/7708f5ce19fe2ebbcf8323d38c0004df0f163b1e)
- Remove obsolete TokenStorage. [`40bda27`](https://github.com/ecphp/cas-bundle/commit/40bda276dcc9e4619f98c3d1e510c341acb54a85)
- Sync from master branch. [`537f228`](https://github.com/ecphp/cas-bundle/commit/537f228180c6fcc5e1e3457f30f7e02c0bb5f7c2)
- Remove the renew parameter if it is found in the URL. [`23713ac`](https://github.com/ecphp/cas-bundle/commit/23713ac453f318e8e5cb349b08d29b71f5c8d6e2)
- Implement an alternative solution when user authentication has failed. [`a7f8f99`](https://github.com/ecphp/cas-bundle/commit/a7f8f9996d4e3a46e26ababef867db9370269bbd)
- Add status to the JSON response in case of failure. [`427e081`](https://github.com/ecphp/cas-bundle/commit/427e081ca8261e58bddfe313c76e6a3a8219610e)
- Prevent infinite redirection loops when authentication failed on the client side. [`2abf8f8`](https://github.com/ecphp/cas-bundle/commit/2abf8f8653f3c8f1a56cdb6a147852b2ecf864a4)
- Sync from master branch. [`5416eff`](https://github.com/ecphp/cas-bundle/commit/5416eff265271cbce6953af84bdb36b877e9aa64)
- Sync from master branch. [`3c39a6b`](https://github.com/ecphp/cas-bundle/commit/3c39a6b023289f7d3258aa55140d808a1326bf78)
- Sync from master branch. [`10d042a`](https://github.com/ecphp/cas-bundle/commit/10d042a320bc10551026526a80c328cb86ed77cc)
- Remove ocular from dependencies and use the phar. [`98b873b`](https://github.com/ecphp/cas-bundle/commit/98b873ba763a6945d9e381370610454ab1c75866)
- Sync Travis configuration. [`b3fa231`](https://github.com/ecphp/cas-bundle/commit/b3fa231f4f37694ace3515012eaefd47dc6b1850)
- Add tests. [`4ae3502`](https://github.com/ecphp/cas-bundle/commit/4ae3502794e3828df697205074403b128d54346d)
- Add tests. [`8f50ba6`](https://github.com/ecphp/cas-bundle/commit/8f50ba6fa15fe58ae3793bcae5aaeb00c207301c)
- Add tests. [`161d75e`](https://github.com/ecphp/cas-bundle/commit/161d75eb3a4899dcfb65312dd1997a1bebb8b3e3)
- Fix typo. [`d0dfe4e`](https://github.com/ecphp/cas-bundle/commit/d0dfe4eda39317b9bfc3e53655438a671ba6ec17)
- Minor update of Guard authenticator. [`b523732`](https://github.com/ecphp/cas-bundle/commit/b523732c23c6ee38c052517c07f70b13e5aee5d6)
- Add more tests. [`9c42334`](https://github.com/ecphp/cas-bundle/commit/9c423342bc1301d2dfa7a78ce9c7503748d267ad)
- Update composer.json. [`f1e9e8e`](https://github.com/ecphp/cas-bundle/commit/f1e9e8e31e39ed925287f017eb3b7dba1e137d67)
- Update badges. [`5f88950`](https://github.com/ecphp/cas-bundle/commit/5f8895078ed79c52fce78addbe9ae87e200a3465)
- Update tests. [`09487bc`](https://github.com/ecphp/cas-bundle/commit/09487bcaacfae87ff1293721852b50c3081b78e1)
- Update composer.json. [`2f05e1e`](https://github.com/ecphp/cas-bundle/commit/2f05e1e363471daea01155f4097fadc837b401cf)
- Update composer.json. [`65d6569`](https://github.com/ecphp/cas-bundle/commit/65d65693b455944459b15806f7da301484557ad1)
- Add scrutinizer configuration. [`b52314a`](https://github.com/ecphp/cas-bundle/commit/b52314ad90e5f45a60035788e1480c9b78722afd)
- Add some badges for swag. [`c6b7e05`](https://github.com/ecphp/cas-bundle/commit/c6b7e05f20047cc8995c48a0aa26b1df3131042f)
- Add travis configuration. [`56276df`](https://github.com/ecphp/cas-bundle/commit/56276df3176d3b1dcd3a8733d3a23884d9808fc6)
- Update documentation. [`bdd1637`](https://github.com/ecphp/cas-bundle/commit/bdd163771e7a8c2784a191fb6b82c6cd733e88a3)
- Add tests. [`92b3bdd`](https://github.com/ecphp/cas-bundle/commit/92b3bddf29d3f1868d778f92b3ae8caf0a28b6e5)
- Minor change. [`3e47854`](https://github.com/ecphp/cas-bundle/commit/3e47854b8b30222634bca6a83888be3a64d0d96a)
- Add the httpFoundationFactory service back for the proxy callback auth only. [`661b4fe`](https://github.com/ecphp/cas-bundle/commit/661b4fef8c7e58f53c8118f0b0ceb66c23b9c8b6)
- Update tests based on latest changes from master branch. [`fe67b91`](https://github.com/ecphp/cas-bundle/commit/fe67b911a5ba7e53b115341971cfa03454d5cb78)
- Remove one dependency from the Guard. [`2cef4b3`](https://github.com/ecphp/cas-bundle/commit/2cef4b3965e2e4e3796689f7f5f675607103478d)
- Add tests. [`319305d`](https://github.com/ecphp/cas-bundle/commit/319305d100d485d7bd10145bb78121db522deb5a)
- Fix Symfony ^5 compatibility. [`c326894`](https://github.com/ecphp/cas-bundle/commit/c32689472e28a18c17157877fff43114a37a7937)
- Fix Symfony ^4.4 compatibility. [`2a8c5cb`](https://github.com/ecphp/cas-bundle/commit/2a8c5cb8756523534cd881705721753bc95e9a78)
- Add initial tests tools and smoke test. [`0f528dd`](https://github.com/ecphp/cas-bundle/commit/0f528dd05db3500fbe39bfceb51baf02ab9f442f)
- Update the Guard authenticator. [`58e6b67`](https://github.com/ecphp/cas-bundle/commit/58e6b671eaa04f1effee225e34471c902cf25de0)
- Remove the configuration to avoid any security concerns. [`0dca6c7`](https://github.com/ecphp/cas-bundle/commit/0dca6c720fdbff9d69c41e0a767b93c62536db97)
- Update default CAS homepage with more information to the end user. [`cb0f7e9`](https://github.com/ecphp/cas-bundle/commit/cb0f7e9ecbe7c91f3531336b718333dff212d34f)
- Move configuration files under the specific dev environment. [`e470035`](https://github.com/ecphp/cas-bundle/commit/e470035ad14340365c21620b75d9e19943a5591a)
- Rename files for more consistency. [`a7d3e5e`](https://github.com/ecphp/cas-bundle/commit/a7d3e5e72a04bd13197e5586d3e53d7764dd3d26)
- More documentation updates and config files update. [`f46cbf6`](https://github.com/ecphp/cas-bundle/commit/f46cbf650a28957cdb97fc2c8ce94032b17d71e1)
- Minor documentation updates. [`357fd11`](https://github.com/ecphp/cas-bundle/commit/357fd11824c647574237a9a8bd613b870ad2d5c5)
- Minor documentation updates. [`aeb152c`](https://github.com/ecphp/cas-bundle/commit/aeb152c4c5248932e3b72713b9a066351845c69e)
- Update documentation. [`f0a8ac1`](https://github.com/ecphp/cas-bundle/commit/f0a8ac19508f338c6a41cd928ee3afe4e3007bae)
- Initial commit. [`3ddde8d`](https://github.com/ecphp/cas-bundle/commit/3ddde8d2318ca1536dd000f05864599862598650)
