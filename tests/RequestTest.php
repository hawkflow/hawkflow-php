<?php

namespace HawkFlow\HawkFlow\tests;

use HawkFlow\HawkFlow\HawkFlowException;
use HawkFlow\HawkFlow\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    /** @test */
    public function timed_data_valid()
    {
        $process = 'process_name';
        $meta = '';
        $uid = '';

        $data = Request::timedData($process, $meta, $uid);
        $this->assertSame(['process' => 'process_name'], $data);
    }

    /** @test */
    public function timed_data_valid_full()
    {
        $process = 'process_name';
        $meta = 'meta_data';
        $uid = 'uid';

        $data = Request::timedData($process, $meta, $uid);
        $this->assertSame(['process' => 'process_name', 'meta' => 'meta_data', 'uid' => 'uid'], $data);
    }

    /** @test */
    public function timed_data_empty_process()
    {
        $process = '';
        $meta = '';
        $uid = '';

        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^No process set\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Request::timedData($process, $meta, $uid);
    }

    /** @test */
    public function timed_data_invalid_process()
    {
        $process = 'process name ❌';
        $meta = '';
        $uid = '';

        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^Process parameter contains unsupported characters\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Request::timedData($process, $meta, $uid);
    }

    /** @test */
    public function timed_data_invalid_meta()
    {
        $process = 'process_name';
        $meta = 'invalid meta ❌';
        $uid = '';

        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^Meta parameter contains unsupported characters\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Request::timedData($process, $meta, $uid);
    }

    /** @test */
    public function timed_data_invalid_uid()
    {
        $process = 'process_name';
        $meta = '';
        $uid = 'invalid uid ❌';

        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^UID parameter contains unsupported characters\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Request::timedData($process, $meta, $uid);
    }

    /** @test */
    public function exception_data_valid()
    {
        $message = 'exception message';
        $process = 'process_name';
        $meta = '';

        $data = Request::exceptionData($message, $process, $meta);
        $this->assertSame(['exception' => 'exception message', 'process' => 'process_name'], $data);
    }

    /** @test */
    public function exception_data_valid_with_meta()
    {
        $message = 'exception message';
        $process = 'process_name';
        $meta = 'meta_data';

        $data = Request::exceptionData($message, $process, $meta);
        $this->assertSame(['exception' => 'exception message', 'process' => 'process_name', 'meta' => 'meta_data'], $data);
    }

    /** @test */
    public function exception_data_empty_message()
    {
        $message = '';
        $process = 'process_name';
        $meta = '';

        $data = Request::exceptionData($message, $process, $meta);
        $this->assertSame(['exception' => '', 'process' => 'process_name'], $data);
    }

    /** @test */
    public function exception_data_empty_process()
    {
        $message = 'exception message';
        $process = '';
        $meta = '';

        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^No process set\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Request::exceptionData($message, $process, $meta);
    }

    /** @test */
    public function exception_data_invalid_process()
    {
        $message = 'exception message';
        $process = 'process name ❌';
        $meta = '';

        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^Process parameter contains unsupported characters\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Request::exceptionData($message, $process, $meta);
    }

    /** @test */
    public function exception_data_invalid_meta()
    {
        $message = 'exception message';
        $process = 'process_name';
        $meta = 'invalid meta ❌';

        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^Meta parameter contains unsupported characters\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Request::exceptionData($message, $process, $meta);
    }

    /** @test */
    public function metrics_data_valid()
    {
        $items = ['key' => 123];
        $process = 'process_name';
        $meta = '';

        $data = Request::metricsData($items, $process, $meta);
        $this->assertSame(['items' => ['key' => 123], 'process' => 'process_name'], $data);
    }

    /** @test */
    public function metrics_data_valid_with_meta()
    {
        $items = ['key' => 123];
        $process = 'process_name';
        $meta = 'meta_data';

        $data = Request::metricsData($items, $process, $meta);
        $this->assertSame(['items' => ['key' => 123], 'process' => 'process_name', 'meta' => 'meta_data'], $data);
    }

    /** @test */
    public function metrics_data_empty_items()
    {
        $items = [];
        $process = 'process_name';
        $meta = '';

        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^No items set\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Request::metricsData($items, $process, $meta);
    }

    /** @test */
    public function metrics_data_empty_process()
    {
        $items = ['key' => 123];
        $process = '';
        $meta = '';

        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^No process set\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Request::metricsData($items, $process, $meta);
    }

    /** @test */
    public function metrics_data_invalid_process()
    {
        $items = ['key' => 123];
        $process = 'process name ❌';
        $meta = '';

        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^Process parameter contains unsupported characters\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Request::metricsData($items, $process, $meta);
    }
}
