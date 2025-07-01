<?php

namespace App;

final class Constants
{
    const MXGO = 'mxgo';

    const FREE = 'free';
    const PRO = 'pro';

    const OWNER = 'owner';
    const OPERATOR = 'operator';
    const GUEST = 'guest';

    const IGNORED = "ignored";

    const YEAR = "Y";
    const MONTH = "M";
    const DAY = "D";

    const OC = "O/C";
    const NORMAL = "normal";
    const OVERDUE = "overdue";
    const NEAR = "near";
    const NOT_APPLICABLE = "NOT_APPLICABLE";

    const PART = "part";
    const SERVICE = "service";

    const MINIMUM_HOURS = 25;
    const MINIMUM_DAYS = 60;
    const MINIMUM_CYCLES = 25;

    const AD = 'ad';
    const DA = 'da';
    const CF = 'cf';

    const ROLE_SUPER_MASTER = 'super_master';
    const ROLE_MASTER = 'master';
    const ROLE_CTM = 'ctm';
    const ROLE_OPERATOR = 'operator';
    const ROLE_GARAGE = 'garage';

    const STATUS_APPLE_ACTIVE = 1;
    const STATUS_APPLE_EXPIRED = 2;
    const STATUS_APPLE_BILLING_RETRY_PERIOD = 3;
    const STATUS_APPLE_BILLING_GRACE_PRIOD = 4;
    const STATUS_APPLE_REVOKED = 5;

    const ROLE_GARAGE_OWNER = 'owner';
    const ROLE_GARAGE_MANAGER_RESPONSIBLE = 'manager_responsible';
    const ROLE_GARAGE_TECHNICAL_MANAGER = 'technical_manager';
    const ROLE_GARAGE_INSPECTOR = 'inspector';
    const ROLE_GARAGE_MECHANIC = 'mechanic';
    const ROLE_GARAGE_MECHANIC_ASSISTANT = 'mechanic_assistant';
    const ROLE_GARAGE_COMMERCIAL = 'commercial';
    const ROLE_GARAGE_CTM = 'ctm';
    const ROLE_GARAGE_FINANCIAL = 'financial';
    const ROLE_GARAGE_FINANCIAL_MASTER = 'financial_master';
    const ROLE_GARAGE_PAINTER = 'painter';
    const ROLE_GARAGE_PAINTER_ASSISTANT = 'painter_assistant';
    const ROLE_GARAGE_OTHERS = 'others';

    const TEAM = [self::ROLE_SUPER_MASTER, self::ROLE_MASTER, self::ROLE_CTM];
    const TEAM_MASTER = [self::ROLE_SUPER_MASTER, self::ROLE_MASTER];

    const ACTIVE = 'active';
    const AVAILABLE = 'available';
    const UNAVAILABLE = 'unavailable';
    const WAITING_AUDIT = 'waiting_audit';
    const SUSPENDED = 'suspended';
    const INACTIVE = 'inactive';
    const INCOMPLETE = 'incomplete';
    const DISAPPROVED = 'disapproved';
    const APPROVED = 'approved';
    const APPROVED_GARAGE = 'approved_garage';
    const DESISTED = 'desisted';
    const DECLINED = 'declined';
    const PENDING = 'pending';
    const PENDING_STATUS_REPORT = 'pending_status_report';
    const DRAFT = 'draft';
    const WARRANTY = 'warranty';
    const COURTESY = 'courtesy';
    const INFORMATIVE = 'informative';
    const WAITING_FOR_APPROVAL = 'waiting_for_approval';
    const NOT_STARTED = 'not_started';
    const WAITING_PAYMENT = 'waiting_payment';
    const PROCESS_PAYMENT = 'process_payment';
    const IN_PROCESS = 'in_process';
    const FINISHED = 'finished';
    const IN_SERVICE = 'in_service';
    const INVOICED = 'invoiced';
    const CANCELED = 'canceled';
    const REPPROVED = 'repproved';
    const REPPROVED_GARAGE = 'repproved_garage';
    const PENDING_REGISTRATION = 'pending_registration';
    const UPDATED_REGISTRATION = 'updated_registration';
    const COMPONENT_REMOVED = 'component_removed';
    const MAINTENANCE_REMOVED = 'maintenance_removed';
    const PAID = "paid";
    const EXPIRED = "expired";
    const SENDED = "sended";
    const NO_GO = "no_go";

    const DISCREPANCY = 'discrepancy';
    const TRAVEL_EXPENSE = 'travel_expense';
    const MECHANIC_DAILY = 'mechanic_daily';
    const FREIGHT = 'freight';
    const THIRD_PARTY_SERVICES = 'third_party_services';

    const STATUSES_ITEMS_BUDGET = [
        self::WARRANTY,
        self::COURTESY,
        self::DISCREPANCY,
        self::TRAVEL_EXPENSE,
        self::MECHANIC_DAILY,
        self::FREIGHT,
        self::THIRD_PARTY_SERVICES,
    ];

    const COMPONENT_AIRFRAME = 'airframe';

    const COMPONENT_LEFT_ENGINE = 'left_engine';
    const COMPONENT_RIGHT_ENGINE = 'right_engine';
    const COMPONENT_MAIN_ENGINE = 'main_engine';
    const COMPONENT_RIGHT_ENGINE_CT = 'right_engine_ct';
    const COMPONENT_RIGHT_ENGINE_PT = 'right_engine_pt';
    const COMPONENT_RIGHT_ENGINE_IMP = 'right_engine_imp';
    const COMPONENT_LEFT_ENGINE_CT = 'left_engine_ct';
    const COMPONENT_LEFT_ENGINE_PT = 'left_engine_pt';
    const COMPONENT_LEFT_ENGINE_IMP = 'left_engine_imp';
    const COMPONENT_MAIN_PROPELLER = 'main_propeller';
    const COMPONENT_LEFT_PROPELLER = 'left_propeller';
    const COMPONENT_RIGHT_PROPELLER = 'right_propeller';
    const COMPONENT_TAIL_ROTOR = 'tail_rotor';
    const COMPONENT_MAIN_ROTOR = 'main_rotor';
    const COMPONENT_RH_MAIN_LANDING_GEAR = 'rh_main_landing_gear';
    const COMPONENT_LH_MAIN_LANDING_GEAR = 'lh_main_landing_gear';
    const COMPONENT_LH_MAIN_LANDING_GEAR_IN = 'lh_main_landing_gear_in';
    const COMPONENT_RH_MAIN_LANDING_GEAR_IN = 'rh_main_landing_gear_in';
    const COMPONENT_LH_MAIN_LANDING_GEAR_OUT = 'lh_main_landing_gear_out';
    const COMPONENT_RH_MAIN_LANDING_GEAR_OUT = 'rh_main_landing_gear_out';
    const COMPONENT_NOISE_LANDING_GEAR = 'nose_landing_gear';
    const COMPONENT_AIR_CONDITIONING = 'air_conditioning';
    const COMPONENT_JANITROL = 'janitrol';
    const COMPONENT_AUXILIARY_POWER_UNIT = 'auxiliary_power_unit';
    const COMPONENT_IMPELLER = 'impeller';
    const COMPONENT_POWER_TURBINE = 'power_turbine';
    const COMPONENT_COMPRESSOR_TURBINE = 'compressor_turbine';

    const GROUP_AIRFRAMES = 'airframes';
    const GROUP_ENGINES = 'engines';
    const GROUP_PROPELLERS = 'propellers';
    const GROUP_LANDING_GEAR = 'landing_gear';
    const GROUP_ROTOR = 'rotor';
    const GROUP_GAS_GENERATOR_TURBINE_BLADE = "gas_generator_turbine_blade";
    const GROUP_POWER_TURBINE_BLADE = "power_turbine_blade";

    const COMPONENT_OPTIONS = [
        Constants::COMPONENT_LEFT_ENGINE,
        Constants::COMPONENT_RIGHT_ENGINE,
        Constants::COMPONENT_MAIN_ENGINE,
        Constants::COMPONENT_RIGHT_ENGINE_CT,
        Constants::COMPONENT_RIGHT_ENGINE_PT,
        Constants::COMPONENT_RIGHT_ENGINE_IMP,
        Constants::COMPONENT_LEFT_ENGINE_CT,
        Constants::COMPONENT_LEFT_ENGINE_PT,
        Constants::COMPONENT_LEFT_ENGINE_IMP,
        Constants::COMPONENT_MAIN_PROPELLER,
        Constants::COMPONENT_LEFT_PROPELLER,
        Constants::COMPONENT_RIGHT_PROPELLER,
        Constants::COMPONENT_TAIL_ROTOR,
        Constants::COMPONENT_MAIN_ROTOR,
        Constants::COMPONENT_RH_MAIN_LANDING_GEAR,
        Constants::COMPONENT_LH_MAIN_LANDING_GEAR,
        Constants::COMPONENT_LH_MAIN_LANDING_GEAR_IN,
        Constants::COMPONENT_RH_MAIN_LANDING_GEAR_IN,
        Constants::COMPONENT_LH_MAIN_LANDING_GEAR_OUT,
        Constants::COMPONENT_RH_MAIN_LANDING_GEAR_OUT,
        Constants::COMPONENT_NOISE_LANDING_GEAR,
        Constants::COMPONENT_AIR_CONDITIONING,
        Constants::COMPONENT_JANITROL,
        Constants::COMPONENT_AUXILIARY_POWER_UNIT,
        Constants::COMPONENT_IMPELLER,
        Constants::COMPONENT_POWER_TURBINE,
        Constants::COMPONENT_COMPRESSOR_TURBINE,
    ];

    const GROUP_COMPONENTS = [
        self::GROUP_AIRFRAMES,
        self::GROUP_ENGINES,
        self::GROUP_PROPELLERS,
        self::GROUP_LANDING_GEAR,
        self::GROUP_ROTOR,
        self::COMPONENT_JANITROL,
        self::COMPONENT_AIR_CONDITIONING,
        self::COMPONENT_AUXILIARY_POWER_UNIT,
        self::COMPONENT_IMPELLER,
        self::COMPONENT_POWER_TURBINE,
        self::COMPONENT_COMPRESSOR_TURBINE,
    ];

    const OPTIONS_TYPE_CONTACTS = [];
    const OPTIONS_TYPE_PERSONS = [];
    const OPTIONS_CONTRIBUTOR = [];

    const SUBSCRIPTION_OPERATOR_ANUALLY = 'operator_pro_anually';
    const SUBSCRIPTION_OPERATOR_MONTHLY = 'operator_pro_monthly';
    const SUBSCRIPTION_GARAGE_MONTHLY = 'oficina-pro';

    const PERCENT_TAX_APP = 'percent_tax_app';

    const CF_OCCURRENCE_UNIQUE = 'unique';
    const CF_OCCURRENCE_WEEKLY = 'weekly';
    const CF_OCCURRENCE_MONTHLY = 'monthly';
    const CF_OCCURRENCE_QUARTERLY = 'quarterly';
    const CF_OCCURRENCE_SEMIANNUAL = 'semiannual';
    const CF_OCCURRENCE_INSTALLMENTS = 'installments';

    const OPTIONS_OCCURRENCE_CASHFLOW = [
        self::CF_OCCURRENCE_UNIQUE,
        self::CF_OCCURRENCE_WEEKLY,
        self::CF_OCCURRENCE_MONTHLY,
        self::CF_OCCURRENCE_QUARTERLY,
        self::CF_OCCURRENCE_SEMIANNUAL,
        self::CF_OCCURRENCE_INSTALLMENTS,
    ];

    const CF_SUNDAY = 'sunday';
    const CF_MONDAY = 'monday';
    const CF_TUESDAY = 'tuesday';
    const CF_WEDNESDAY = 'wednesday';
    const CF_THURSDAY = 'thursday';
    const CF_FRIDAY = 'friday';
    const CF_SATURDAY = 'saturday';

    const CF_TO_PAY = "to_pay";
    const CF_TO_RECEIVE = "to_receive";

    const CF_PAID = "paid";
    const CF_RECEIVED = "received";
    const CF_OVERDUE = "overdue";
    const CF_COMING_DUE = "coming_due";

    const CF_TO_RECEIVE_CUSTOMERS = 'customers';
    const CF_TO_RECEIVE_UNIQUE_OCCURRENCE = 'unique';

    const AIRWORTHINESS_DIRECTIVES_REPORT = 'airworthiness_directives_report';
    const MAINTENANCE_STATUS_REPORT = 'maintenance_status_report';
    const SERVICE_BULLETINS = 'service_bulletins';

    const REMOVED = 'removed';
    const INSTALLED = 'installed';

    const RETURNED = 'returned';
    const IN_USE = 'in_use';
}
