<?php

namespace AsyncAws\CloudFormation\ValueObject;

use AsyncAws\CloudFormation\Enum\DetailedStatus;
use AsyncAws\CloudFormation\Enum\HookFailureMode;
use AsyncAws\CloudFormation\Enum\HookInvocationPoint;
use AsyncAws\CloudFormation\Enum\HookStatus;
use AsyncAws\CloudFormation\Enum\ResourceStatus;
use AsyncAws\Core\Exception\InvalidArgument;

/**
 * The StackEvent data type.
 */
final class StackEvent
{
    /**
     * The unique ID name of the instance of the stack.
     *
     * @var string
     */
    private $stackId;

    /**
     * The unique ID of this event.
     *
     * @var string
     */
    private $eventId;

    /**
     * The name associated with a stack.
     *
     * @var string
     */
    private $stackName;

    /**
     * The logical name of the resource specified in the template.
     *
     * @var string|null
     */
    private $logicalResourceId;

    /**
     * The name or unique identifier associated with the physical instance of the resource.
     *
     * @var string|null
     */
    private $physicalResourceId;

    /**
     * Type of resource. (For more information, go to Amazon Web Services Resource Types Reference [^1] in the
     * *CloudFormation User Guide*.).
     *
     * [^1]: https://docs.aws.amazon.com/AWSCloudFormation/latest/UserGuide/aws-template-resource-type-ref.html
     *
     * @var string|null
     */
    private $resourceType;

    /**
     * Time the status was updated.
     *
     * @var \DateTimeImmutable
     */
    private $timestamp;

    /**
     * Current status of the resource.
     *
     * @var ResourceStatus::*|null
     */
    private $resourceStatus;

    /**
     * Success/failure message associated with the resource.
     *
     * @var string|null
     */
    private $resourceStatusReason;

    /**
     * BLOB of the properties used to create the resource.
     *
     * @var string|null
     */
    private $resourceProperties;

    /**
     * The token passed to the operation that generated this event.
     *
     * All events triggered by a given stack operation are assigned the same client request token, which you can use to
     * track operations. For example, if you execute a `CreateStack` operation with the token `token1`, then all the
     * `StackEvents` generated by that operation will have `ClientRequestToken` set as `token1`.
     *
     * In the console, stack operations display the client request token on the Events tab. Stack operations that are
     * initiated from the console use the token format *Console-StackOperation-ID*, which helps you easily identify the
     * stack operation . For example, if you create a stack using the console, each stack event would be assigned the same
     * token in the following format: `Console-CreateStack-7f59c3cf-00d2-40c7-b2ff-e75db0987002`.
     *
     * @var string|null
     */
    private $clientRequestToken;

    /**
     * The name of the hook.
     *
     * @var string|null
     */
    private $hookType;

    /**
     * Provides the status of the change set hook.
     *
     * @var HookStatus::*|null
     */
    private $hookStatus;

    /**
     * Provides the reason for the hook status.
     *
     * @var string|null
     */
    private $hookStatusReason;

    /**
     * Invocation points are points in provisioning logic where hooks are initiated.
     *
     * @var HookInvocationPoint::*|null
     */
    private $hookInvocationPoint;

    /**
     * Specify the hook failure mode for non-compliant resources in the followings ways.
     *
     * - `FAIL` Stops provisioning resources.
     * - `WARN` Allows provisioning to continue with a warning message.
     *
     * @var HookFailureMode::*|null
     */
    private $hookFailureMode;

    /**
     * An optional field containing information about the detailed status of the stack event.
     *
     * - `CONFIGURATION_COMPLETE` - all of the resources in the stack have reached that event. For more information, see
     *   CloudFormation stack deployment [^1] in the *CloudFormation User Guide*.
     *
     * - `VALIDATION_FAILED` - template validation failed because of invalid properties in the template. The
     *   `ResourceStatusReason` field shows what properties are defined incorrectly.
     *
     * [^1]: https://docs.aws.amazon.com/AWSCloudFormation/latest/UserGuide/stack-resource-configuration-complete.html
     *
     * @var DetailedStatus::*|null
     */
    private $detailedStatus;

    /**
     * @param array{
     *   StackId: string,
     *   EventId: string,
     *   StackName: string,
     *   LogicalResourceId?: null|string,
     *   PhysicalResourceId?: null|string,
     *   ResourceType?: null|string,
     *   Timestamp: \DateTimeImmutable,
     *   ResourceStatus?: null|ResourceStatus::*,
     *   ResourceStatusReason?: null|string,
     *   ResourceProperties?: null|string,
     *   ClientRequestToken?: null|string,
     *   HookType?: null|string,
     *   HookStatus?: null|HookStatus::*,
     *   HookStatusReason?: null|string,
     *   HookInvocationPoint?: null|HookInvocationPoint::*,
     *   HookFailureMode?: null|HookFailureMode::*,
     *   DetailedStatus?: null|DetailedStatus::*,
     * } $input
     */
    public function __construct(array $input)
    {
        $this->stackId = $input['StackId'] ?? $this->throwException(new InvalidArgument('Missing required field "StackId".'));
        $this->eventId = $input['EventId'] ?? $this->throwException(new InvalidArgument('Missing required field "EventId".'));
        $this->stackName = $input['StackName'] ?? $this->throwException(new InvalidArgument('Missing required field "StackName".'));
        $this->logicalResourceId = $input['LogicalResourceId'] ?? null;
        $this->physicalResourceId = $input['PhysicalResourceId'] ?? null;
        $this->resourceType = $input['ResourceType'] ?? null;
        $this->timestamp = $input['Timestamp'] ?? $this->throwException(new InvalidArgument('Missing required field "Timestamp".'));
        $this->resourceStatus = $input['ResourceStatus'] ?? null;
        $this->resourceStatusReason = $input['ResourceStatusReason'] ?? null;
        $this->resourceProperties = $input['ResourceProperties'] ?? null;
        $this->clientRequestToken = $input['ClientRequestToken'] ?? null;
        $this->hookType = $input['HookType'] ?? null;
        $this->hookStatus = $input['HookStatus'] ?? null;
        $this->hookStatusReason = $input['HookStatusReason'] ?? null;
        $this->hookInvocationPoint = $input['HookInvocationPoint'] ?? null;
        $this->hookFailureMode = $input['HookFailureMode'] ?? null;
        $this->detailedStatus = $input['DetailedStatus'] ?? null;
    }

    /**
     * @param array{
     *   StackId: string,
     *   EventId: string,
     *   StackName: string,
     *   LogicalResourceId?: null|string,
     *   PhysicalResourceId?: null|string,
     *   ResourceType?: null|string,
     *   Timestamp: \DateTimeImmutable,
     *   ResourceStatus?: null|ResourceStatus::*,
     *   ResourceStatusReason?: null|string,
     *   ResourceProperties?: null|string,
     *   ClientRequestToken?: null|string,
     *   HookType?: null|string,
     *   HookStatus?: null|HookStatus::*,
     *   HookStatusReason?: null|string,
     *   HookInvocationPoint?: null|HookInvocationPoint::*,
     *   HookFailureMode?: null|HookFailureMode::*,
     *   DetailedStatus?: null|DetailedStatus::*,
     * }|StackEvent $input
     */
    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getClientRequestToken(): ?string
    {
        return $this->clientRequestToken;
    }

    /**
     * @return DetailedStatus::*|null
     */
    public function getDetailedStatus(): ?string
    {
        return $this->detailedStatus;
    }

    public function getEventId(): string
    {
        return $this->eventId;
    }

    /**
     * @return HookFailureMode::*|null
     */
    public function getHookFailureMode(): ?string
    {
        return $this->hookFailureMode;
    }

    /**
     * @return HookInvocationPoint::*|null
     */
    public function getHookInvocationPoint(): ?string
    {
        return $this->hookInvocationPoint;
    }

    /**
     * @return HookStatus::*|null
     */
    public function getHookStatus(): ?string
    {
        return $this->hookStatus;
    }

    public function getHookStatusReason(): ?string
    {
        return $this->hookStatusReason;
    }

    public function getHookType(): ?string
    {
        return $this->hookType;
    }

    public function getLogicalResourceId(): ?string
    {
        return $this->logicalResourceId;
    }

    public function getPhysicalResourceId(): ?string
    {
        return $this->physicalResourceId;
    }

    public function getResourceProperties(): ?string
    {
        return $this->resourceProperties;
    }

    /**
     * @return ResourceStatus::*|null
     */
    public function getResourceStatus(): ?string
    {
        return $this->resourceStatus;
    }

    public function getResourceStatusReason(): ?string
    {
        return $this->resourceStatusReason;
    }

    public function getResourceType(): ?string
    {
        return $this->resourceType;
    }

    public function getStackId(): string
    {
        return $this->stackId;
    }

    public function getStackName(): string
    {
        return $this->stackName;
    }

    public function getTimestamp(): \DateTimeImmutable
    {
        return $this->timestamp;
    }

    /**
     * @return never
     */
    private function throwException(\Throwable $exception)
    {
        throw $exception;
    }
}
