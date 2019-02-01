<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Neptune;

/**
 */
class NeptunePoolClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Neptune\PingRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Ping(\Neptune\PingRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/neptune.NeptunePool/Ping',
        $argument,
        ['\Neptune\PingReply', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Neptune\DoRegistRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function DoRegist(\Neptune\DoRegistRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/neptune.NeptunePool/DoRegist',
        $argument,
        ['\Neptune\DoResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Neptune\DoReleaseRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function DoRelease(\Neptune\DoReleaseRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/neptune.NeptunePool/DoRelease',
        $argument,
        ['\Neptune\DoResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Neptune\DoRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function DoFun(\Neptune\DoRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/neptune.NeptunePool/DoFun',
        $argument,
        ['\Neptune\DoResponse', 'decode'],
        $metadata, $options);
    }

}
