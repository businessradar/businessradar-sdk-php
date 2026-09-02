# Changelog

## [0.6.0](https://github.com/businessradar/businessradar-sdk-php/compare/v0.5.1...v0.6.0) (2026-09-02)


### Features

* sync API from production ([#18](https://github.com/businessradar/businessradar-sdk-php/issues/18)) ([a9f442f](https://github.com/businessradar/businessradar-sdk-php/commit/a9f442f229f57ee3196add4ca7f01b84f91c79dc))
* sync API from production ([#20](https://github.com/businessradar/businessradar-sdk-php/issues/20)) ([ac8ef6c](https://github.com/businessradar/businessradar-sdk-php/commit/ac8ef6cc92e29c0fc7e82d8cb5fb320dd7f2a955))
* sync API from production ([#21](https://github.com/businessradar/businessradar-sdk-php/issues/21)) ([4c0a087](https://github.com/businessradar/businessradar-sdk-php/commit/4c0a087cc5805f09a7c17b250cafc3bacad469df))

## 0.5.1 (2026-06-09)

Full Changelog: [v0.5.0...v0.5.1](https://github.com/businessradar/businessradar-sdk-php/compare/v0.5.0...v0.5.1)

## 0.5.0 (2026-06-09)

Full Changelog: [v0.4.0...v0.5.0](https://github.com/businessradar/businessradar-sdk-php/compare/v0.4.0...v0.5.0)

### Features

* **api:** api update ([fe209b6](https://github.com/businessradar/businessradar-sdk-php/commit/fe209b674f6b8cc1969da9999c7189b14c48cf92))
* **api:** api update ([2019514](https://github.com/businessradar/businessradar-sdk-php/commit/201951414e048c2e927c70f936aaf825377164d1))
* **api:** api update ([c8fc459](https://github.com/businessradar/businessradar-sdk-php/commit/c8fc45953de5bf3510f149b71a70808ec79cd85c))
* **api:** api update ([b7fb282](https://github.com/businessradar/businessradar-sdk-php/commit/b7fb282a82a82b08726cde416b857d181048a5db))
* **api:** api update ([0945033](https://github.com/businessradar/businessradar-sdk-php/commit/0945033cf26495fda143f5924495a99f913a39f9))
* **api:** api update ([eb5f654](https://github.com/businessradar/businessradar-sdk-php/commit/eb5f6548005bb48566af2c7d16580d6e7938d617))
* **api:** api update ([277de42](https://github.com/businessradar/businessradar-sdk-php/commit/277de4253605b056c8dfc0280db55c5e9b94d42a))
* **api:** api update ([d395463](https://github.com/businessradar/businessradar-sdk-php/commit/d3954635ecddb2a91f1a03efde34bf929a52d053))
* **api:** api update ([da7d149](https://github.com/businessradar/businessradar-sdk-php/commit/da7d149ebc588174b4c8201d13c20a76539e5511))
* **api:** manual updates ([ab5d406](https://github.com/businessradar/businessradar-sdk-php/commit/ab5d4065e0fd44efefd8cc982400bd46f09cd4e9))
* **api:** manual updates ([6900aef](https://github.com/businessradar/businessradar-sdk-php/commit/6900aef92b0457d5fc0297e9913190a8aede3082))
* **api:** manual updates ([b2eaf9d](https://github.com/businessradar/businessradar-sdk-php/commit/b2eaf9ddcf405955a8e10842c6980e1f68b51574))
* support setting headers via env ([77622d8](https://github.com/businessradar/businessradar-sdk-php/commit/77622d802488223547f13a961a61249858740cc8))


### Bug Fixes

* **client:** properly generate file params ([0e21edf](https://github.com/businessradar/businessradar-sdk-php/commit/0e21edf93e69d10d61b68e2e0e406cf3876d69a3))
* **client:** resolve serialization issue with unions and enums ([9f66d8d](https://github.com/businessradar/businessradar-sdk-php/commit/9f66d8d978a576e1d50adfdd9f991ce37a39934d))
* guzzle requires special handling to enable streaming ([600acf4](https://github.com/businessradar/businessradar-sdk-php/commit/600acf44b34394c4ba2cde42ee6a34fec4096fc2))
* populate enum-typed properties with enum instances ([afaef9f](https://github.com/businessradar/businessradar-sdk-php/commit/afaef9fedb3792d6d29e3e0100bfe8e503f2b249))
* **release:** use canonical GitHub URL in Packagist publish script ([ae51e0c](https://github.com/businessradar/businessradar-sdk-php/commit/ae51e0c847d9a64d5b4d334df76e411232e9296b))
* revert enum parsing change that lead to unconditional failure ([91fd20b](https://github.com/businessradar/businessradar-sdk-php/commit/91fd20bb5eec16ac93026360071f51036026af63))


### Chores

* **internal:** codegen related update ([cc59f42](https://github.com/businessradar/businessradar-sdk-php/commit/cc59f421e706eaa263ccfc01ab85d78375171435))
* **internal:** tweak CI branches ([93c8da8](https://github.com/businessradar/businessradar-sdk-php/commit/93c8da82c6c2b495f6ebc14afaf5e9b2e147af61))

## 0.4.0 (2026-03-13)

Full Changelog: [v0.3.0...v0.4.0](https://github.com/businessradar/businessradar-sdk-php/compare/v0.3.0...v0.4.0)

### Features

* **api:** api update ([c1d64d2](https://github.com/businessradar/businessradar-sdk-php/commit/c1d64d28d08384f076964afc8a38bbe2098ab8bf))
* **api:** api update ([aecc1a0](https://github.com/businessradar/businessradar-sdk-php/commit/aecc1a0be85f06bae2c2f6585580bdf2d9e04af6))
* **api:** api update ([75bcecf](https://github.com/businessradar/businessradar-sdk-php/commit/75bcecfc2890628a770a7d80b3779d5d5fd0318b))
* use `$_ENV` aware getenv helper ([674386b](https://github.com/businessradar/businessradar-sdk-php/commit/674386be8fc61294fdcec3123a05db19b157cfe0))


### Bug Fixes

* used redirect count instead of retry count in base client ([81e5f1a](https://github.com/businessradar/businessradar-sdk-php/commit/81e5f1a202687cc926237f2296a53ea460d296f9))


### Chores

* **internal:** codegen related update ([1ccd0fc](https://github.com/businessradar/businessradar-sdk-php/commit/1ccd0fc824f739e879f22dc5121d3e1dc08c27bd))
* **internal:** php cs fixer should not be memory limited ([991eda3](https://github.com/businessradar/businessradar-sdk-php/commit/991eda36359fc9d87802604206b59733d277e720))
* **internal:** remove mock server code ([6eba5b5](https://github.com/businessradar/businessradar-sdk-php/commit/6eba5b57843d3ed76ed4c43828f711867c435f31))
* **internal:** upgrade phpunit ([8e12cca](https://github.com/businessradar/businessradar-sdk-php/commit/8e12ccae687c9f076c059bc5b2aed51a345618f5))
* **release:** add packagist trigger on published release ([5510fce](https://github.com/businessradar/businessradar-sdk-php/commit/5510fce38b7df8291dcabd931483bb87015c9b0d))
* update mock server docs ([d8dba45](https://github.com/businessradar/businessradar-sdk-php/commit/d8dba450b3c05d8bcc4789a8a3ffa58bed728116))

## 0.3.0 (2026-01-30)

Full Changelog: [v0.2.0...v0.3.0](https://github.com/businessradar/businessradar-sdk-php/compare/v0.2.0...v0.3.0)

### Features

* **api:** api update ([3ad4436](https://github.com/businessradar/businessradar-sdk-php/commit/3ad443614b1a7c3d736d0fd5c6e561b8034f2578))
* **api:** api update ([985e321](https://github.com/businessradar/businessradar-sdk-php/commit/985e32144480438c88e4759b5e78e26c0f8cf132))
* **api:** api update ([4118c0c](https://github.com/businessradar/businessradar-sdk-php/commit/4118c0c4e22cf12f8fd3ff5017bf4b35017e39ce))
* **api:** api update ([025e6a9](https://github.com/businessradar/businessradar-sdk-php/commit/025e6a9f1b83efd26a32ebb11d3bebc3c03ce04a))
* **api:** api update ([f913b23](https://github.com/businessradar/businessradar-sdk-php/commit/f913b23d13b098cea70c5e7e9e4f9c173b76c06a))
* **api:** api update ([78ca32c](https://github.com/businessradar/businessradar-sdk-php/commit/78ca32c318d2ee7d05309b1c49f201e66929a189))
* **api:** api update ([ddf3e32](https://github.com/businessradar/businessradar-sdk-php/commit/ddf3e32031948ebb1804b8535f9a3044887c227d))
* **api:** manual updates ([0baa1d2](https://github.com/businessradar/businessradar-sdk-php/commit/0baa1d2b3dd2ede4e3c73718594f8b9c3bfa79df))

## 0.2.0 (2026-01-30)

Full Changelog: [v0.1.0...v0.2.0](https://github.com/businessradar/businessradar-sdk-php/compare/v0.1.0...v0.2.0)

### Features

* **api:** manual updates ([d12199c](https://github.com/businessradar/businessradar-sdk-php/commit/d12199c08293231c82fd5bfede2c2cb96f1e2ff1))

## 0.1.0 (2026-01-30)

Full Changelog: [v0.0.1...v0.1.0](https://github.com/businessradar/businessradar-sdk-php/compare/v0.0.1...v0.1.0)

### Features

* **api:** api update ([0581495](https://github.com/businessradar/businessradar-sdk-php/commit/0581495748e95f0fe46a0b0d34e9e9baa1336a27))
* **api:** api update ([ca10d00](https://github.com/businessradar/businessradar-sdk-php/commit/ca10d00342109777ee63ea422265dba00099d01b))
* **api:** manual updates ([afe2d06](https://github.com/businessradar/businessradar-sdk-php/commit/afe2d06317d556cb6c5a0ae7d16d4b2f74cae1f3))
* **api:** manual updates ([2b88cf4](https://github.com/businessradar/businessradar-sdk-php/commit/2b88cf464b3f67bda09abf73cf205b09ec34f73a))


### Chores

* configure new SDK language ([4a671e0](https://github.com/businessradar/businessradar-sdk-php/commit/4a671e0d517313c6933c1bbd557914a6359bb1f4))
* **internal:** ignore stainless-internal artifacts ([58cd017](https://github.com/businessradar/businessradar-sdk-php/commit/58cd017a242dbf4e1b0bcfe887ce798d440a04f5))
* update SDK settings ([6bc6b55](https://github.com/businessradar/businessradar-sdk-php/commit/6bc6b5527124ea91f50a04b9413d1e33ceaa1ec1))
